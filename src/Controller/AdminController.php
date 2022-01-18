<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\UserRepository;
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
     * displays the list of users
     * @Route("/users", name="users")
     */
    public function showUsers(UserRepository $userRepository): Response
    {
        return $this->render('admin/users.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * displays the details of a user
     * @Route("/users{id}", name="user_show", methods={"GET"})
     */
    public function showOneUser(User $user): Response
    {
        return $this->render('admin/user_show.html.twig', [
            'user' => $user,
        ]);
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

    /**
     * @Route("/skill/{id}/edit", name="skill_edit")
     */
    public function edit(Request $request, Skill $skill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($skill);
            $entityManager->flush();

            return $this->redirectToRoute('admin_skill', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/skill_edit.html.twig', [
            'skill' => $skill,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/skill/{id}/delete", name="skill_delete")
     */
    public function delete(Request $request, Skill $skill, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (is_string($request->request->get('_token')) && $user instanceof User) {
            if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
                $entityManager->remove($skill);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('admin_skill', [], Response::HTTP_SEE_OTHER);
    }
}
