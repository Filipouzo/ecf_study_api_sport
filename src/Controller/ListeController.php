<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;





class ListeController extends AbstractController
{
    #[Route('administrateur/liste/{userToAdmin}', name: 'administrateur_liste')]
    public function adminList(Request $request, UserRepository $users, $userToAdmin)
    {

        $parentId = $request->query->get('parentId');
        $parentName = $request->query->get('parentName');

        if ($parentId !='0') {

            return $this->render("pages/listeUser.html.twig", [
                'users' => $users->findByParentId($parentId),
                'parentName' => $users->findById($parentId),
                'pageName' => 'liste structure',
                'userToAdmin' => $userToAdmin,
                'parentId' => $parentId,
                'parentName' => $parentName
    

            ]);

        dd ( $parentId);

        } else {
            return $this->render("pages/listeUser.html.twig", [
            'users' => $users->findByRole('ROLE_'. strtoupper($userToAdmin)),
            'pageName' => 'liste '.$userToAdmin,
            'userToAdmin' => $userToAdmin,
            'parentId' => $parentId


            /* findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) */
        ]);

        }

    }

    #[Route('partenaire/liste/structure', name: 'partenaire_liste')]
    public function partenaireList(Request $request, UserRepository $users)
    {
        $connectedUserId = $request->query->get('connectedUserId');
        return $this->render("pages/listeUser.html.twig", [
            'users' => $users->findByParentId($connectedUserId),
            'pageName' => 'liste structure',
            'userToAdmin' => 'structure'

            /* findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) */
        ]);
    }
}

