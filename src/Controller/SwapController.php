<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Skill;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Route("/swapper/display/{skill_id}/{user_id}", name="swapper_display")
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
}
