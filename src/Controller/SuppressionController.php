<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class SuppressionController extends AbstractController
{
    #[Route('administrateur/suppression/{id}', name: 'suppression', methods: ['GET', 'POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        $userToAdmin = $request->query->get('userToAdmin');


        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

/*         return $this->redirectToRoute('administrateur_liste', array('userToAdmin' => $userToAdmin) ); */
        return $this->redirectToRoute('administrateur_accueil', [], Response::HTTP_SEE_OTHER);
    }
}
