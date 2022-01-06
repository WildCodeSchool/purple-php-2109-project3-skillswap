<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/users")
 */
class UsersController extends AbstractController
{
    /**
     * @Route("/new", name="users_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/profile", name="users_profile")
     */
    public function profile(): Response
    {
        return $this->render('users/profile.html.twig', [
            'user' => $this->getUser(),
        ]);
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
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // verification upload picture
            $picture = $form->get('picture')->getData();

            // this condition is needed because the 'picuture' field is not required
            if ($picture instanceof UploadedFile && $user instanceof Users) {
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
            'user' => $user,
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
        if (is_string($request->request->get('_token')) && $user instanceof Users) {
            if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
                $entityManager->remove($user);
                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }
}
