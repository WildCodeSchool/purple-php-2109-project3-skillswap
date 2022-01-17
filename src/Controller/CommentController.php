<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/comment", name="comment")
 */
class CommentController extends AbstractController
{
    /**
     * This is the form that lets a user send a comment after a swap.
     * The user who gets the comment is fetched from the url.
     * @Route("/{id} ", name="", methods={"GET", "POST"}, requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER")
     */
    public function index(
        User $recipient,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $currentUser = $this->getUser();
            if ($currentUser instanceof User) {
                $comment->setSender($currentUser);
                $comment->setRecipient($recipient);
                $data = $form->getData();
                dd($data);
                $comment->setDate(new DateTime());
                $entityManager->persist($comment);
                $entityManager->flush();
                $this->addFlash(
                    "success",
                    "Votre commentaire a bien été envoyé."
                );
                return $this->redirectToRoute("comment", [
                    "id" => $recipient->getId(),
                ]);
            }
        }
        return $this->render("comment/index.html.twig", [
            "form" => $form->createView(),
        ]);
    }
}
