<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/skills", name="skills_")
 */
class SkillController extends AbstractController
{
    /**
     * @Route("/research", name="research", methods={"GET"})
     */
    public function research(SkillRepository $skillRepository): Response
    {
        return $this->render('skills/research.html.twig', [
            'skills' => $skillRepository->findBy([], ['category' => 'ASC']),
            'categories' => Skill::CATEGORIES,
        ]);
    }
}
