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
    #[Route('administrateur/liste', name: 'administrateur_liste')]
    public function adminList(Request $request, UserRepository $userRepository)
    {        
        $userToAdmin = $request->query->get('userToAdmin');
        $parentId = $request->query->get('parentId');
        $parentName = $request->query->get('parentName');

        $searchResult = $request->query->get('id');
        $searchTerm = $request->query->get('q');
/*         $searchResult = $userRepository->findByName($searchTerm); */

/*         $searchResult = $userRepository->search(
            'name',
            $searchTerm
        ); */

/*            if ($request->query->get('preview')) {

            dd($searchTerm);
            return $this->render('partials/_searchPreview.html.twig', [
                'users' => $searchResult,
            ]);
        } */
        
            if ($parentId !='0') {
                // retourne la liste des administrateurs ou des partenaires
                return $this->render("pages/listeUser.html.twig", [
                    'users' => $userRepository->findByParentId($parentId,$searchResult),
                    /* 'parentName' => $users->findById($parentId), */
                    'pageName' => 'liste '.$userToAdmin,
                    'userToAdmin' => $userToAdmin,
                    'parentId' => $parentId,
                    'parentName' => $parentName,
                    'searchTerm' => $searchTerm,
                    'id' => $searchResult,
                ]);

            } else {
                // retourne la liste des structures
                return $this->render("pages/listeUser.html.twig", [
                'users' => $userRepository->findByRole('ROLE_'.strtoupper($userToAdmin),$searchResult),
                'pageName' => 'liste '.$userToAdmin,
                'userToAdmin' => $userToAdmin,
                'parentName' => $parentName,
                'parentId' => '0',
                'searchTerm' => $searchTerm,
                'id' => $searchResult,
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
        ]);
    }
}

