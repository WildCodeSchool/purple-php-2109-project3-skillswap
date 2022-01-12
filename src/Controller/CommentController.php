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

/**
 * @Route("/comment", name="comment_")
 */
class CommentController extends AbstractController
{
    /**
     * This is the form that lets a user send a comment after a swap.
     * The user who gets the comment is fetched from the url.
     * @Route("/{id} ", name="form", methods={"GET", "POST"}, requirements={"id"="\d+"})
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
                $comment->setDate(new DateTime());
                $entityManager->persist($comment);
                $entityManager->flush();
                return $this->redirectToRoute("comment_valid");
            }
        }
        return $this->render("comment/index.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    /**
     * If the form sent is valid, we send the user to this page to inform them it is valid.
     * @Route("/valid", name="valid")
     */
    public function valid(Request $request): Response
    {
        return $this->render("comment/valid.html.twig");
    }
}
