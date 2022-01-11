<?php

namespace App\Controller;

use App\Entity\Skills;
use App\Repository\UsersRepository;
use App\Repository\SkillsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SwapController extends AbstractController
{
    /**
     * @Route("/swap/research/{id}", name="swap_research", requirements={"id"="\d+"})
     */
    public function research(Skills $skill): Response
    {
        return $this->render('swap/research.html.twig', [
            'skill' => $skill
        ]);
    }
}
