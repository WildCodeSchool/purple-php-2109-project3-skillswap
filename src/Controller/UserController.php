<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Comment;
use App\Form\UserSkillType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManager;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

/**
 * @Route("/users", name="users_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     * @IsGranted("ROLE_USER")
     */
    public function profile(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserSkillType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($user instanceof User) {
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('users_profile');
            }
        }
        return $this->renderForm('users/profile.html.twig', [
              'form' => $form,
        ]);
    }

    /**
     * @Route("/edit", name="edit_profile")
     * @IsGranted("ROLE_USER")
     */
    public function edit(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // verification upload picture
            $picture = $form->get('picture')->getData();

            // this condition is needed because the 'picuture' field is not required
            if ($picture instanceof UploadedFile && $user instanceof User) {
                $newFilename = 'avatar' . '-' . $user->getId() . '.' . $picture->guessExtension();
                // Move the file to the directory where brochures are stored
                if (is_string($this->getParameter('pictures_directory'))) {
                    try {
                        $picture->move(
                            $this->getParameter('pictures_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                        return $this->render('errors/error500.html.twig');
                    }
                }
                // instead of its contents
                $user->setPicture($newFilename);
            }
            $entityManager->flush();
            return $this->redirectToRoute('users_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/edit_profile.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete", name="delete")
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (is_string($request->request->get('_token')) && $user instanceof User) {
            if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
                $entityManager->remove($user);
                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/availability", name="availability")
     * @IsGranted("ROLE_USER")
     */
    public function availability(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($user instanceof User) {
            if ($user->getAvailable()) {
                $user->setAvailable(false);
            } else {
                $user->setAvailable(true);
            }
            $entityManager->flush();
        }
        return $this->redirectToRoute('users_profile');
    }

    /**
     * A method of assigning the Admin Role once to a single administrator.
     * This instruction is specified in the ReadMe to be used by the person who will
     * administer the site at the time of installation. This method can only be accessed via the url.
     * @Route("/profile/admin", name="profile_admin")
     * @IsGranted("ROLE_USER")
     */
    public function createAdmin(UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $roleAdmin = true;
        $users = $userRepository->findAll();
        foreach ($users as $user) {
            $roles = $user->getRoles();
            if (in_array('ROLE_ADMIN', $roles)) {
                $roleAdmin = false;
            }
        }
        if ($roleAdmin) {
            if ($this->getUser() instanceof User) {
                $this->getUser()->setRoles(['ROLE_ADMIN']);
                $entityManager->flush();
                $this->addFlash('notice', 'Vous obtenez le role Admin');
                return $this->redirectToRoute('users_profile');
            }
        }
        $this->addFlash(
            'notice',
            'Un utilisateur possede deja le Role Admin merci d\'utiliser le formaulaire de contact pour en savoir plus.'
        );
        return $this->redirectToRoute('users_profile');
    }

    /**
     * @Route("/comment/{id}/delete", name="comment_delete")
     */
    public function deleteComment(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (is_string($request->request->get('_token')) && $user instanceof User) {
            if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
                $entityManager->remove($comment);
                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('users_profile', [], Response::HTTP_SEE_OTHER);
    }
}
