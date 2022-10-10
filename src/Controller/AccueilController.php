<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// /**
// * @Route("/admin",name="admin_")
// */


class AccueilController extends AbstractController
{
    #[Route('admin/accueil', name: 'admin_accueil')]
    public function admin_accueil(): Response
    {
        return $this->render('pages/accueil.html.twig', [
            'pageName' => 'Accueil',
            'userRole' => 'administrateur'
        ]);
    }

    #[Route('partenaire/accueil', name: 'partenaire_accueil')]
    public function partenaire_accueil(): Response
    {
        return $this->render('pages/accueil.html.twig', [
            'pageName' => 'Accueil Partenaire',
            'userRole' => 'partenaire'
        ]);
    }

    #[Route('structure/accueil', name: 'structure_accueil')]
    public function structure_accueil(): Response
    {
        return $this->render('pages/accueil.html.twig', [
            'pageName' => 'Accueil Strcture',
            'userRole' => 'structure'
        ]);
    }
}
