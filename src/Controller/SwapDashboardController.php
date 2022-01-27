<?php

namespace App\Controller;

use App\Entity\Swap;
use App\Entity\User;
use App\Entity\Discussion;
use App\Form\DiscussionType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class SwapDashboardController extends AbstractController
{
    /**
     * @Route("/swap/dashboard/{id}", name="swap_dashboard", requirements={"id"="\d+"})
     */
    public function index(
        Swap $swap,
        Request $request,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response {
        if (
            ($this->getUser() instanceof User) &&
            ($swap->getAsker() instanceof User) &&
            ($swap->getHelper() instanceof User)
        ) {
            if ($this->getUser()->getId() === $swap->getAsker()->getId()) {
                $sender = $swap->getAsker()->getEmail();
                $recipient = $swap->getHelper()->getEmail();
            } elseif ($this->getUser()->getId() === $swap->getHelper()->getId()) {
                $sender = $swap->getHelper()->getEmail();
                $recipient = $swap->getAsker()->getEmail();
            } else {
                return $this->redirectToRoute("home");
            }

            $discussion = new Discussion($swap, $this->getUser());
            $form = $this->createForm(DiscussionType::class, $discussion);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($discussion);
                $entityManager->flush();
            }

            if (is_string($sender) && is_string($recipient)) {
                $email = (new Email())
                    ->from($sender)
                    ->to($recipient)
                    ->subject("Notification concernant votre demande d'aide n°" . $swap->getId())
                    ->html($this->renderView("swap_dashboard/send.html.twig", [
                        'swap' => $swap,
                    ]));
                $mailer->send($email);
            }
            return $this->render('swap_dashboard/index.html.twig', [
                'swap' => $swap,
                "form" => $form->createView(),
            ]);
        }
        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/swap/finish/{id}", name="swap_finish", requirements={"id"="\d+"})
     */
    public function finish(Swap $swap, EntityManagerInterface $entityManager): Response
    {
        $swap->setIsDone(true);
        $entityManager->persist($swap);
        $entityManager->flush();

        $this->addFlash(
            "success",
            "Votre swap a bien été cloturé."
        );
        return $this->redirectToRoute("swap_dashboard", [
            "id" => $swap->getId(),
        ]);
    }
}
