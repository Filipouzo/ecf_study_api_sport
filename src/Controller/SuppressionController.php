<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class SuppressionController extends AbstractController
{
    #[Route('administrateur/suppression/{id}', name: 'suppression', methods:  ['GET', 'POST'])]
    public function delete(request $request, User $user, EntityManagerInterface $entityManager): Response
    {

        $userToAdmin = $request->query->get('userToAdmin');
        $parentId = $request->query->get('parentId');
/* 
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('delete-item', $submittedToken)) {
        } */
        
        $entityManager->remove($user);
        $entityManager->flush($user);


        $this-> addFlash('notice', 'enregistrement supprmé avec succès');
        return $this->redirectToRoute('administrateur_liste', array('userToAdmin' => $userToAdmin, 'parentId'=> $parentId ) );
    }

}
