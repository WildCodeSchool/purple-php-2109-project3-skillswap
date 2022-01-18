<?php

namespace App\Controller;

use DateTime;
use App\Entity\Swap;
use App\Entity\User;
use App\Form\SwapType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/swap", name="swap_")
*/
class SwapController extends AbstractController
{
    /**
    * @Route("/{id} ", name="form", methods={"GET", "POST"}, requirements={"id"="\d+"})
    */
    public function index(
        User $helper,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $swap = new Swap();
        $form = $this->createForm(SwapType::class, $swap);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $currentUser = $this->getUser();
            if ($currentUser instanceof User) {
                $swap->setAsker($currentUser);
                $swap->setHelper($helper);
                $swap->setDate(new DateTime());
                $entityManager->persist($swap);
                $entityManager->flush();
                $this->addFlash(
                    "success",
                    "Votre demande de swap a bien été envoyé."
                );
                return $this->redirectToRoute("swap_form", [
                    "id" => $helper->getId(),
                ]);
            }
        }
        return $this->render('swap/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
