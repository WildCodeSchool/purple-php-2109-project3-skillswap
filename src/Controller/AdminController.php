<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Skill;
use App\Entity\Comment;
use App\Form\SkillType;
use App\Repository\UserRepository;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Route("/user/{id}", name="user_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function showOneUser(User $user): Response
    {
        return $this->render('admin/user_show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/user/{idUser}/delete/{idComment}",
     *      name="comment_delete",
     *      requirements={"idUser"="\d+", "idComment"="\d+}
     *      )
     * @ParamConverter("comment",class="App\Entity\Comment", options = {"mapping": {"idComment": "id"}})
     */
    public function deleteComment(
        int $idUser,
        Request $request,
        Comment $comment,
        EntityManagerInterface $entityManager
    ): Response {

        $user = $this->getUser();
        if (is_string($request->request->get('_token')) && $user instanceof User) {
            if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
                $entityManager->remove($comment);
                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('admin_user_show', ['id' => $idUser], Response::HTTP_SEE_OTHER);
    }

    /**
     * displays the details of a user
     * @Route("/user/{id}/addrole", name="user_add_role", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function addRoleAdmin(User $user, EntityManagerInterface $entityManager): Response
    {
        if (in_array("ROLE_ADMIN", $user->getRoles())) {
            $user->setRoles([]);
            $entityManager->flush();
        } else {
            $user->setRoles(['ROLE_ADMIN']);
            $entityManager->flush();
        }
        return $this->redirectToRoute('admin_user_show', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
    }

    /**
     * deletes an user's profile
     * @Route("/user/{id}/delete", name="user_delete", requirements={"id"="\d+"})
     */
    public function deleteUser(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $userAdmin = $this->getUser();
        if (is_string($request->request->get('_token')) && $userAdmin instanceof User) {
            if ($this->isCsrfTokenValid('delete' . $userAdmin->getId(), $request->request->get('_token'))) {
                $entityManager->remove($user);
                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('admin_users', [], Response::HTTP_SEE_OTHER);
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
     * show the name and category of a skill and lets the admin edit those
     * @Route("/skill/{id}/edit", name="skill_edit", requirements={"id"="\d+"})
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
     * deletes a skill (after being shown a warning message)
     * @Route("/skill/{id}/delete", name="skill_delete", requirements={"id"="\d+"})
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
