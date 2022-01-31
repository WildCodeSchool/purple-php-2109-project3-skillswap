<?php

namespace App\Controller;

use App\Entity\Swap;
use App\Entity\User;
use App\Entity\Discussion;
use App\Service\SortUserAskerHelper;
use App\Form\DiscussionType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/swap", name="swap_")
 * @IsGranted("ROLE_USER")
 */
class SwapDashboardController extends AbstractController
{
    /**
     * @Route("/dashboard/{id}", name="dashboard", requirements={"id"="\d+"})
     */
    public function index(
        Swap $swap,
        Request $request,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer,
        SortUserAskerHelper $sorter
    ): Response {
        $users = $sorter->sort([
            "user" => $this->getUser(),
            "asker" => $swap->getAsker(),
            "helper" => $swap->getHelper()
        ]);

        if ($users !== [false]) {
            $mainUser = $users["mainUser"];
            $sender = $users["mainUser"]->getEmail();
            $recipient = $users["secondUser"]->getEmail();

            $discussion = new Discussion($swap, $mainUser);
            $form = $this->createForm(DiscussionType::class, $discussion);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($discussion);
                $entityManager->flush();

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
            }
            return $this->render('swap_dashboard/index.html.twig', [
                'swap' => $swap,
                "form" => $form->createView(),
            ]);
        }
        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/finish/{id}", name="finish", requirements={"id"="\d+"})
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
