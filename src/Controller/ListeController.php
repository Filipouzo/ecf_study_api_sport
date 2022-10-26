<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\Mapping\Id;
use App\Repository\UserRepository;
use App\Repository\OptionRepository;
use App\Repository\GlobalOptionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;





class ListeController extends AbstractController
{
    #[Route('administrateur/liste', name: 'administrateur_liste')]
    public function adminList(Request $request, UserRepository $userRepository, GlobalOptionRepository $globalOptionRepository, OptionRepository $optionRepository)
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
                    'global_options' => $globalOptionRepository->findByIdPartner($parentId),
                    'options' => $optionRepository->findByIdStructure($parentId),
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
                'global_options' => $globalOptionRepository->findByIdPartner($parentId),
                'options' => $optionRepository->findByIdStructure($parentId),
                ]);
            }
    }

/*     #[Route('partenaire/liste/structure', name: 'partenaire_liste')]
    public function partenaireList(Request $request, UserRepository $users)
    {
        $connectedUserId = $request->query->get('connectedUserId');
        return $this->render("pages/listeUser.html.twig", [
            'parentId' => $parentId,
            'pageName' => 'liste structure',
            'userToAdmin' => 'structure'
        ]);
    } */
}

