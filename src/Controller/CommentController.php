<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Users;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/comment", name="comment_")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/{id} ", name="form")
     */
    public function index(Users $recipient, Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
                $currentUser = $this->getUser();
                // @phpstan-ignore-next-line
                $comment->setSender($currentUser);
                $comment->setRecipient($recipient);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($comment);
                $entityManager->flush();
                return $this->redirectToRoute("comment_valid");
        }
        return $this->render("comment/index.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/valid", name="valid")
     */
    public function valid(Request $request): Response
    {
        return $this->render("comment/valid.html.twig");
    }
}
