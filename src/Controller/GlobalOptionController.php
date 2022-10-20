<?php

namespace App\Controller;

use App\Entity\GlobalOption;
use App\Form\GlobalOptionType;
use App\Repository\GlobalOptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/global/option')]
class GlobalOptionController extends AbstractController
{
    #[Route('/', name: 'app_global_option_index', methods: ['GET'])]
    public function index(GlobalOptionRepository $globalOptionRepository): Response
    {
        return $this->render('global_option/index.html.twig', [
            'global_options' => $globalOptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_global_option_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GlobalOptionRepository $globalOptionRepository): Response
    {
        dd('salut');

        $globalOption = new GlobalOption();
        $form = $this->createForm(GlobalOptionType::class, $globalOption);
        dd($form->isSubmitted());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $globalOptionRepository->save($globalOption, true);

            return $this->redirectToRoute('app_global_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('global_option/new.html.twig', [
            'global_option' => $globalOption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_global_option_show', methods: ['GET'])]
    public function show(GlobalOption $globalOption): Response
    {
        return $this->render('global_option/show.html.twig', [
            'global_option' => $globalOption,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_global_option_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GlobalOption $globalOption, GlobalOptionRepository $globalOptionRepository): Response
    {
        $form = $this->createForm(GlobalOptionType::class, $globalOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $globalOptionRepository->save($globalOption, true);

            return $this->redirectToRoute('app_global_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('global_option/edit.html.twig', [
            'global_option' => $globalOption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_global_option_delete', methods: ['POST'])]
    public function delete(Request $request, GlobalOption $globalOption, GlobalOptionRepository $globalOptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$globalOption->getId(), $request->request->get('_token'))) {
            $globalOptionRepository->remove($globalOption, true);
        }

        return $this->redirectToRoute('app_global_option_index', [], Response::HTTP_SEE_OTHER);
    }
}
