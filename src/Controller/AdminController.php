<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin", name="admin_")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * displays the administrator's dashboard
     * @Route("/", name="dashboard")
     */
    public function dashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    /**
     * show, add and modify the list of skills
     * @Route("/skill", name="skill")
     */
    public function showSkill(
        Request $request,
        SkillRepository $skillRepository,
        EntityManagerInterface $entityManager
    ): Response {

        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($skill);
            $entityManager->flush();

            return $this->redirectToRoute('admin_skill', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin/skill.html.twig', [
            'skills' => $skillRepository->findBy([], ['name' => 'ASC']),
            'form' => $form,
        ]);
    }
}
