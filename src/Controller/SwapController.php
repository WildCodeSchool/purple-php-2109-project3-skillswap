<?php

namespace App\Controller;

use App\Entity\Swap;
use App\Entity\User;
use App\Entity\Skill;
use App\Service\SortUserAskerHelper;
use App\Form\SwapType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Mailer\MailerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/swap")
 * @IsGranted("ROLE_USER")
 */
class SwapController extends AbstractController
{
    /**
     * Shows the list of swappers who declared themselves competent on the skill in parameter and are available
     * @Route("/research/{id}", name="swap_research", requirements={"id"="\d+"})
     */
    public function research(Skill $skill): Response
    {
        $usersAvailable = [];
        foreach ($skill->getUser() as $user) {
            if ($user->getAvailable() && $user !== $this->getUser()) {
                $usersAvailable[] = $user;
            }
        }
        return $this->render('swap/research.html.twig', [
            'skill' => $skill,
            'usersAvailable' => $usersAvailable
        ]);
    }

    /**
     * Show the profile of the selected user
     * @Route("/display/{skill_id}/{user_id}", name="swapper_display", requirements={"skill_id"="\d+", "user_id"="\d+"})
     * @ParamConverter("skill",class="App\Entity\Skill", options = {"mapping": {"skill_id": "id"}})
     * @ParamConverter("user",class="App\Entity\User", options = {"mapping": {"user_id": "id"}})
     */
    public function display(Skill $skill, User $user): Response
    {
        if ($this->getUser() instanceof User) {
            if ($this->getUser()->getId() === $user->getId()) {
                return $this->render('swap/research.html.twig', [
                    'skill' => $skill
                ]);
            }
            return $this->render('swap/display.html.twig', [
                'user' => $user,
                'skill' => $skill,
            ]);
        }

        return $this->render('swap/research.html.twig', [
            'skill' => $skill
        ]);
    }

    /**
     * Shows and handles the form that lets the user start a swap
     * When a swap is started, an email is sent to the other user
     * @Route("/ask/{skill_id}/{user_id} ", name="swap_form", requirements={"skill_id"="\d+", "user_id"="\d+"})
     * @ParamConverter("skill",class="App\Entity\Skill", options = {"mapping": {"skill_id": "id"}})
     * @ParamConverter("helper",class="App\Entity\User", options = {"mapping": {"user_id": "id"}})
     */
    public function index(
        User $helper,
        Skill $skill,
        Request $request,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer,
        SortUserAskerHelper $sorter
    ): Response {
        $currentUser = $this->getUser();
        if ($currentUser instanceof User) {
            if ($currentUser->getId() === $helper->getId()) {
                return $this->render('swap/research.html.twig', [
                    'skill' => $skill
                ]);
            }

            $swap = new Swap($currentUser, $helper, $skill);
            $form = $this->createForm(SwapType::class, $swap);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($swap);
                $entityManager->flush();

                if (
                    ($swap->getSkill() instanceof Skill) &&
                    is_string($currentUser->getEmail()) &&
                    is_string($helper->getEmail())
                ) {
                    $email = (new Email())
                        ->from($currentUser->getEmail())
                        ->to($helper->getEmail())
                        ->subject("Demande d'aide concernant " . $swap->getSkill()->getName())
                        ->html($this->renderView("swap/request_send.html.twig", [
                            'user' => $swap,
                        ]));
                    $mailer->send($email);

                    $this->addFlash(
                        "success",
                        "Votre demande de swap a bien été envoyée."
                    );
                }
                return $this->redirectToRoute("swap_form", [
                    "user_id" => $helper->getId(),
                    "skill_id" => $skill->getId(),
                ]);
            }
            return $this->render('swap/index.html.twig', [
                "skill" => $skill,
                "user" => $helper,
                "form" => $form->createView(),
            ]);
        }
        return $this->redirectToRoute("home");
    }
}
