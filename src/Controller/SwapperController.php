<?php

namespace App\Controller;

use App\Entity\Swapper;
use App\Form\SwapperType;
use App\Repository\SwapperRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/swapper")
 */
class SwapperController extends AbstractController
{
    /**
     * @Route("/", name="swapper_index", methods={"GET"})
     */
    public function index(SwapperRepository $swapperRepository): Response
    {
        return $this->render('swapper/index.html.twig', [
            'swappers' => $swapperRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="swapper_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $swapper = new Swapper();
        $form = $this->createForm(SwapperType::class, $swapper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($swapper);
            $entityManager->flush();

            return $this->redirectToRoute('swapper_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('swapper/new.html.twig', [
            'swapper' => $swapper,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="swapper_show", methods={"GET"})
     */
    public function show(Swapper $swapper): Response
    {
        return $this->render('swapper/show.html.twig', [
            'swapper' => $swapper,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="swapper_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Swapper $swapper, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SwapperType::class, $swapper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('swapper_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('swapper/edit.html.twig', [
            'swapper' => $swapper,
            'form' => $form,
        ]);
    }
}
