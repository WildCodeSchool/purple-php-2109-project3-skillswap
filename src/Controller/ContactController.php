<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/contact", name="contact")
 */

class ContactController extends AbstractController
{
    /**
     * Recovery of the "ContactType" form to send the view.
     * Checks the validity of the form sent and returns to a
     * page confirming the sending
     * @Route("/", name="")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (is_string($form->get('email')->getData()) && (is_string($this->getParameter('mailer_from')))) {
                $email = (new Email())
                ->from($form->get('email')->getData())
                ->to($this->getParameter('mailer_from'))
                ->subject("Demande d'informations.")
                ->html($this->renderView("contact/send.html.twig", [
                    'user' => $form->getData(),
                ]));
                $mailer->send($email);
                return $this->redirectToRoute("contact_valid");
            }
        }
        return $this->render("contact/index.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    /**
     * confirmation page
     * @Route("/valid", name="_valid")
     */
    public function valid(Request $request): Response
    {
        return $this->render("contact/valid.html.twig");
    }
}
