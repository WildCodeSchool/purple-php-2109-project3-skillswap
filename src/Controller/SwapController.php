<?php

namespace App\Controller;

use DateTime;
use App\Entity\Swap;
use App\Entity\User;
use App\Entity\Skill;
use App\Form\SwapType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
* @Route("/swap")
*/
class SwapController extends AbstractController
{
    /**
     * The method returns the swappers who declared themselves competent on the skill in parameter
     * @Route("/research/{id}", name="swap_research", requirements={"id"="\d+"})
     */
    public function research(Skill $skill): Response
    {
        return $this->render('swap/research.html.twig', [
            'skill' => $skill
        ]);
    }

    /**
     * @Route("/display/{skill_id}/{user_id}", name="swapper_display")
     * @ParamConverter("skill",class="App\Entity\Skill", options = {"mapping": {"skill_id": "id"}})
     * @ParamConverter("user",class="App\Entity\User", options = {"mapping": {"user_id": "id"}})
     */
    public function display(Skill $skill, User $user): Response
    {
        return $this->render('swapper/display.html.twig', [
            'user' => $user,
            'skill' => $skill,
        ]);
    }

    /**
     * @Route("/ask/{skill_id}/{user_id} ", name="swap_form", methods={"GET", "POST"})
     * @ParamConverter("skill",class="App\Entity\Skill", options = {"mapping": {"skill_id": "id"}})
     * @ParamConverter("helper",class="App\Entity\User", options = {"mapping": {"user_id": "id"}})
    */
    public function index(
        User $helper,
        Skill $skill,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $swap = new Swap();
        $form = $this->createForm(SwapType::class, $swap);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $currentUser = $this->getUser();
            if ($currentUser instanceof User) {
                $swap->setAsker($currentUser);
                $swap->setHelper($helper);
                $swap->setSkill($skill);
                $swap->setDate(new DateTime());
                $entityManager->persist($swap);
                $entityManager->flush();
                $this->addFlash(
                    "success",
                    "Votre demande de swap a bien été envoyé."
                );
                return $this->redirectToRoute("swap_form", [
                    "user_id" => $helper->getId(),
                    "skill_id" => $skill->getId(),
                ]);
            }
        }
        return $this->render('swap/index.html.twig', [
            "skill" => $skill,
            "user" => $helper,
            "form" => $form->createView(),
        ]);
    }
}
