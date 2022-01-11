<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/comment", name="comment")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/", name="")
     */
    public function index(Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
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
     * @Route("/valid", name="_valid")
     */
    public function valid(Request $request): Response
    {
        return $this->render("comment/valid.html.twig");
    }
}
