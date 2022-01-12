<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/users")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="users_profile")
     * @IsGranted("ROLE_USER")
     */
    public function profile(): Response
    {
        return $this->render('users/profile.html.twig');
    }

    /**
     * @Route("/edit", name="users_edit_profile")
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
     * @Route("/", name="users_delete")
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
}
