<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersSkillsType;
use App\Security\EmailVerifier;
use App\Form\RegistrationFormType;
use App\Repository\UsersRepository;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class UsersController extends AbstractController
{
   /**
     * @Route("/profile", name="users_profile")
     */
    public function profile(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UsersSkillsType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($user instanceof Users) {
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('users_profile');
            }
        }
        return $this->renderForm('profil/index.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
