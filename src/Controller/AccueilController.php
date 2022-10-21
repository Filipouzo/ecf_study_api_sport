<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// /**
// * @Route("/admin",name="admin_")
// */


class AccueilController extends AbstractController
{

   // redirection vers des routes différentes pour interdire l'accès à l'administration sur les routes /administrateur/*

    #[Route('administrateur/accueil', name: 'administrateur_accueil')]
    public function administrateur_accueil(): Response
    {
        return $this->render('pages/accueil.html.twig', [
            'pageName' => 'Accueil',
            'connectedUser' => $this->getUser()
        ]);
    }

    #[Route('partenaire/accueil', name: 'partenaire_accueil')]
    public function partenaire_accueil(): Response
    {
        return $this->render('pages/accueil.html.twig', [
            'pageName' => 'Accueil Partenaire',
            'userRole' => 'partenaire',
            'connectedUser' => $this->getUser()
        ]);
    }

    #[Route('structure/accueil', name: 'structure_accueil')]
    public function structure_accueil(): Response
    {
        return $this->render('pages/accueil.html.twig', [
            'pageName' => 'Accueil Strcture',
            'userRole' => 'structure',
            'connectedUser' => $this->getUser()
        ]);
    }
}
