<?php

namespace App\Controller;

use App\Entity\Tutor;
use App\Form\TutorType;
use App\Repository\TutorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tutor')]
class TutorController extends AbstractController
{
    #[Route('/', name: 'app_tutor_index', methods: ['GET'])]
    public function index(TutorRepository $tutorRepository): Response
    {
        return $this->render('tutor/index.html.twig', [
            'tutors' => $tutorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tutor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TutorRepository $tutorRepository): Response
    {
        $tutor = new Tutor();
        $form = $this->createForm(TutorType::class, $tutor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tutorRepository->add($tutor, true);

            return $this->redirectToRoute('app_tutor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tutor/new.html.twig', [
            'tutor' => $tutor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tutor_show', methods: ['GET'])]
    public function show(Tutor $tutor): Response
    {
        return $this->render('tutor/show.html.twig', [
            'tutor' => $tutor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tutor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tutor $tutor, TutorRepository $tutorRepository): Response
    {
        $form = $this->createForm(TutorType::class, $tutor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tutorRepository->add($tutor, true);

            return $this->redirectToRoute('app_tutor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tutor/edit.html.twig', [
            'tutor' => $tutor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tutor_delete', methods: ['POST'])]
    public function delete(Request $request, Tutor $tutor, TutorRepository $tutorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tutor->getId(), $request->request->get('_token'))) {
            $tutorRepository->remove($tutor, true);
        }

        return $this->redirectToRoute('app_tutor_index', [], Response::HTTP_SEE_OTHER);
    }
}
