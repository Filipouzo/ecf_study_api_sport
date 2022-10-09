<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin",name="admin_")
 */


class AdministrateursController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('pages/administrateurs.html.twig', [
            'nomPage' => 'Administrateurs'
        ]);
    }

    #[Route('/accueil', name: 'accueil')]
    public function accueil(): Response
    {
        return $this->render('pages/acceuil.html.twig', [
            'nomPage' => 'Accueil'
        ]);
    }

    #[Route('/liste', name: 'liste')]
    public function adminList(UserRepository $users){
        return $this-> render ("pages/liste.html.twig", [
        'users' => $users -> findAll(),
        /* findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) */
        
        'nomPage' => 'liste'
        ]);
    }


}
