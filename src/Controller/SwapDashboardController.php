<?php

namespace App\Controller;

use App\Entity\Swap;
use App\Entity\User;
use App\Entity\Discussion;
use App\Form\DiscussionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SwapDashboardController extends AbstractController
{
    /**
     * @Route("/swap/dashboard/{id}", name="swap_dashboard", requirements={"id"="\d+"})
     */
    public function index(
        Swap $swap,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        if (
            ($this->getUser() instanceof User) &&
            ($swap->getAsker() instanceof User) &&
            ($swap->getHelper() instanceof User)
        ) {
            if (
                $this->getUser()->getId() === $swap->getAsker()->getId() ||
                $this->getUser()->getId() === $swap->getHelper()->getId()
            ) {
                $discussion = new Discussion($swap, $this->getUser());
                $form = $this->createForm(DiscussionType::class, $discussion);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $entityManager->persist($discussion);
                    $entityManager->flush();
                }

                return $this->render('swap_dashboard/index.html.twig', [
                    'swap' => $swap,
                    "form" => $form->createView(),
                ]);
            }
        }
        return $this->redirectToRoute("home");
    }
}
