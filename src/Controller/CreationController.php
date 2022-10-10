<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationController extends AbstractController
{
    #[Route('/structures', name: 'app_structures')]
    public function index(): Response
    {
        return $this->render('pages/structures.html.twig', [
            'pageName' => 'Structures',
        ]);
    }



    #[Route('/creation', name: 'creation')]
    public function creation(): Response
    {
        return $this->render('pages/administrateurs.html.twig', [
            'pageName' => 'Administrateurs'
        ]);
    }
}
