<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;





class ListeController extends AbstractController
{
    #[Route('administrateur/liste/{userToAdmin}', name: 'administrateur_liste')]
    public function adminList(UserRepository $users, $userToAdmin)
    {

        return $this->render("pages/listeUser.html.twig", [
            'users' => $users->findByRole('ROLE_'. strtoupper($userToAdmin)),
            'pageName' => 'liste '.$userToAdmin,
            'userToAdmin' => $userToAdmin

            /* findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) */
        ]);
    }

    #[Route('partenaire/liste/structure', name: 'partenaire_liste_structure')]
    public function partenaireList(UserRepository $users)
    {
        return $this->render("pages/listeUser.html.twig", [
            'users' => $users->findByParentId('81'),
            'pageName' => 'liste structure',
            'userToAdmin' => 'structure'

            /* findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) */
        ]);
    }
}


