<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;





class ListeController extends AbstractController
{
    #[Route('administrateur/liste', name: 'admin_liste')]
    public function adminList(UserRepository $users)
    {
        return $this->render("pages/liste.html.twig", [
            'users' => $users->findAll(),
            'pageName' => 'liste Administrateurs',
            'userToAdmin' => 'administrateur'

            /* findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) */

        ]);
    }

    #[Route('partenaire/liste', name: 'partenaire_liste')]
    public function partenaireList(UserRepository $users)
    {
        return $this->render("pages/liste.html.twig", [
            'users' => $users->findAll(),
            'pageName' => 'liste Partenaires',
            'userToAdmin' => 'partenaire'

            /* findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) */

        ]);
    }

    #[Route('structure/liste', name: 'structure_liste')]
    public function structureList(UserRepository $users)
    {
        return $this->render("pages/liste.html.twig", [
            'users' => $users->findAll(),
            'pageName' => 'liste Partenaires',
            'userToAdmin' => 'structure'

            /* findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) */

        ]);
    }
}
