<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('administrateur/search', name: 'search')]
    public function search(Request $request, UserRepository $userRepository): Response
    {

        $searchTerm = $request->query->get('q');
        $parentId = $request->query->get('parentId');
        $userToAdmin = $request->query->get('userToAdmin');
        $parentName = $request->query->get('parentName');
        

/*         if ($searchTerm){ */

            if ($request->query->get('preview')) {

                    if ($userToAdmin =='structure') {
                    /* recherche de l'adresse */ 
                    $searchResult = $userRepository->findByAddress($searchTerm);
                    } else {
                    /* recherche du nom sur un role administrateur */ 
                    $searchResult = $userRepository->findbyName($searchTerm,'ROLE_'.strtoupper($userToAdmin));
                    } 
        
                    return $this->render('partials/_searchPreview.html.twig', [
                        'users' => $searchResult,
                        'parentId' => $parentId,
                        'userToAdmin' => $userToAdmin,
                        'parentName' => $parentName,
                    ]);
            }
    }
}
