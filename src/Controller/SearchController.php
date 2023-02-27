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
        
            /* s'il y a une recherche  */ 
            if ($request->query->get('preview')) {
                if ($userToAdmin =='structure') {
                    /* recherche dans le UserRepository une liste d'adresses de structures (2 maxi) qui correspondent aux searchTerm */ 
                    $searchResult = $userRepository->findByAddress($searchTerm);
                } else {
                    /* recherche dans le UserRepository une liste de noms d'administrateur (2 maxi) qui correspondent aux searchTerm */ 
                    $searchResult = $userRepository->findbyName($searchTerm,'ROLE_'.strtoupper($userToAdmin));
                } 
    
                /* Appelle la vue partielle searchPreview avec en paramètre la liste des résultats  */ 
                return $this->render('partials/_searchPreview.html.twig', [
                    'users' => $searchResult,
                    'parentId' => $parentId,
                    'userToAdmin' => $userToAdmin,
                    'parentName' => $parentName,
                ]);
            }
    }
}
