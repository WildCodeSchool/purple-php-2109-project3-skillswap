<?php

namespace App\Controller;

use App\Entity\Skills;
use App\Form\SkillsType;
use App\Repository\SkillsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/skills")
 */
class SkillsController extends AbstractController
{

    public const CATEGORIES = [
        'Droit et finance',
        'Marketing et numérique',
        'Commerce et logistique',
        'Administratif',
        'Autres',
    ];

    /**
     * @Route("/research", name="skills_research", methods={"GET"})
     */
    public function research(SkillsRepository $skillsRepository): Response
    {

        return $this->render('skills/research.html.twig', [
            'skills' => $skillsRepository->findBy([], ['category' => 'ASC']),
            'categories' => self::CATEGORIES,
        ]);
    }

    /**
     * @Route("/{id}", name="skills_show", methods={"GET"})
     */
    public function show(Skills $skill): Response
    {
        return $this->render('skills/show.html.twig', [
            'skill' => $skill,
        ]);
    }
}
