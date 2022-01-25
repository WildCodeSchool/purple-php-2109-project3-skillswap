<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Skill;
use App\Repository\SwapRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SwapDashboardController extends AbstractController
{
   /**
     * @Route("/swap/dashboard/{skill_id}/{user_id}", name="swap_dashboard", requirements={"id"="\d+"})
     * @ParamConverter("skill",class="App\Entity\Skill", options = {"mapping": {"skill_id": "id"}})
     * @ParamConverter("helper",class="App\Entity\User", options = {"mapping": {"user_id": "id"}})
     */
    public function index(Skill $skill, User $helper, SwapRepository $swapRepository): Response
    {
        if (($skill->getId() !== null) && ($helper->getId() !== null) && ($this->getUser() !== null)) {
            // @phpstan-ignore-next-line
            $swaps = $swapRepository->getSwapDashboard($skill->getId(), $helper->getId(), $this->getUser()->getId());

            return $this->render('swap_dashboard/index.html.twig', [
                'helper' => $helper,
                'skill' => $skill,
                'swaps' => $swaps,
            ]);
        }
        return $this->redirectToRoute("home");
    }
}
