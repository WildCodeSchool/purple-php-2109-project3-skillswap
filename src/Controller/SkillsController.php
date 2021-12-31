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
     * @Route("/new", name="skills_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $skill = new Skills();
        $form = $this->createForm(SkillsType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($skill);
            $entityManager->flush();

            return $this->redirectToRoute('skills_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('skills/new.html.twig', [
            'skill' => $skill,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="skills_show", methods={"GET"})
     */
    public function show(Skills $skill): Response
    {
        return $this->render('skills/swappers.html.twig', [
            'skill' => $skill,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="skills_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Skills $skill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SkillsType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('skills_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('skills/edit.html.twig', [
            'skill' => $skill,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="skills_delete", methods={"POST"})
     */
    public function delete(Request $request, Skills $skill, EntityManagerInterface $entityManager): Response
    {
        /** @phpstan-ignore-next-line */
        if ($this->isCsrfTokenValid('delete' . $skill->getId(), $request->request->get('_token'))) {
            /** @phpstan-ignore-next-line */
            $entityManager->remove($skill);
            /** @phpstan-ignore-next-line */
            $entityManager->flush();
            /** @phpstan-ignore-next-line */
        }

        return $this->redirectToRoute('skills_index', [], Response::HTTP_SEE_OTHER);
    }
}
