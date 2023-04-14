<?php

namespace App\Controller;

use App\Entity\Acts;
use App\Form\ActsType;
use App\Service\FileUploader;
use App\Repository\ActsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/{_locale<%app.supported_locales%>}/acts')]
class ActsController extends AbstractController
{
    private FileUploader $fileUploader;

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    #[Route('/')]
    /*public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_acts_index', ['_locale' => 'en']);
    }
    */


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
        $renderTemplate = 'acts/new.html.twig';
        $act = new Acts();
        $form = $this->createForm(ActsType::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                try {
                    $imageFileName = $this->fileUploader->upload($imageFile);
                    $act->setImageFileName($imageFileName);
                } catch (FileException $e) {
                    return $this->render($renderTemplate, [
                        'error' => 'An error occurred while uploading your image: ' . $e->getMessage()
                    ]);
                }
            }

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
    public function edit(Request $request, Acts $act, ActsRepository $actsRepository, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(ActsType::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('image')->getData();
            if ($uploadedFile) {
                try {
                    $newFilename = $fileUploader->upload($uploadedFile, $request);
                    $act->setImageFileName($newFilename);
                } catch (FileException $e) {
                    return $this->render('acts/edit.html.twig', [
                        'act' => $act,
                        'form' => $form,
                        'error' => 'An error occurred while uploading your image: ' . $e->getMessage()
                    ]);
                }
            }

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
