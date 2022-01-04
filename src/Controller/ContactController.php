<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;

/**
 * @Route("/contact", name="contact")
 */

class ContactController extends AbstractController
{

    public const MAILER = 'swap.wild@gmail.com';

    /**
     * @Route("/", name="")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
                ->from(self::MAILER)
                ->to(self::MAILER)
                ->subject("Demande d'informations.")
                ->html($this->renderView("contact/send.html.twig", [
                    'user' => $form->getData(),
                ]));
            $mailer->send($email);
            return $this->redirectToRoute("contact_valid");
        }
        return $this->render("contact/index.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/valid", name="_valid")
     */
    public function valid(Request $request): Response
    {
        return $this->render("contact/valid.html.twig");
    }
}
