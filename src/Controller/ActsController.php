<?php

namespace App\Controller;

use App\Entity\Acts;
use App\Form\ActsType;
use App\Repository\ActsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/acts')]
class ActsController extends AbstractController
{
    #[Route('/', name: 'app_acts_index', methods: ['GET'])]
    public function index(ActsRepository $actsRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('acts/index.html.twig', [
            'acts' => $actsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_acts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ActsRepository $actsRepository): Response
    {
        $act = new Acts();
        $form = $this->createForm(ActsType::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actsRepository->save($act, true);

            return $this->redirectToRoute('app_acts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('acts/new.html.twig', [
            'act' => $act,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_acts_show', methods: ['GET'])]
    public function show(Acts $act): Response
    {
        return $this->render('acts/show.html.twig', [
            'act' => $act,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_acts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Acts $act, ActsRepository $actsRepository): Response
    {
        $form = $this->createForm(ActsType::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actsRepository->save($act, true);

            return $this->redirectToRoute('app_acts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('acts/edit.html.twig', [
            'act' => $act,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_acts_delete', methods: ['POST'])]
    public function delete(Request $request, Acts $act, ActsRepository $actsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$act->getId(), $request->request->get('_token'))) {
            $actsRepository->remove($act, true);
        }

        return $this->redirectToRoute('app_acts_index', [], Response::HTTP_SEE_OTHER);
    }
}
