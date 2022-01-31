<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /**
     * @Route("/dashboard", name="dashboard")
     * @IsGranted("ROLE_USER")
     */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        if ($user instanceof User) {
            $swapsAsked = $user->getAskedSwaps();
            $swapsHelped = $user->getHelpedSwaps();

            return $this->render('dashboard/index.html.twig', [
                'swaps_asked' => $swapsAsked,
                'swaps_helped' => $swapsHelped,
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
    }
}
