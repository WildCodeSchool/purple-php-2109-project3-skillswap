<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * The view of the homepage.
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * The view of our terms and condition.
     * @Route("/", name="cgu")
     */
    public function cgu(): Response
    {
        return $this->render('home/cgu.html.twig');
    }
}
