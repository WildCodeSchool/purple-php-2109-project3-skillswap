<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * back to the home page view of the site
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * back to the CGU view of the site
     * @Route("/cgu", name="cgu")
     */
    public function cgu(): Response
    {
        return $this->render('home/cgu.html.twig');
    }
}
