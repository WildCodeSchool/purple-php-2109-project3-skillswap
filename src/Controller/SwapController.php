<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Skill;
use App\Repository\UserRepository;
use App\Repository\SkillRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SwapController extends AbstractController
{
    /**
     * The method returns the swappers who declared themselves competent on the skill in parameter
     * @Route("/swap/research/{id}", name="swap_research", requirements={"id"="\d+"})
     */
    public function research(Skill $skill): Response
    {
        return $this->render('swap/research.html.twig', [
            'skill' => $skill
        ]);
    }

    /** 
     * @Route("/swapper/display/{id}", name="swapper_display")
     */
    public function display(int $id): Response
    {
        return $this->render('swapper/display.html.twig', [
            "id" => $id
        ]);
    }

}
