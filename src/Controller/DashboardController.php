<?php

namespace App\Controller;

use App\Repository\SwapRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(
        SwapRepository $swapRepository
    ): Response {
        $swaps = $swapRepository->findBy(["helper" => $this->getUser()]);

        return $this->render('dashboard/index.html.twig', [
            'swaps' => $swaps,
        ]);
    }
}
