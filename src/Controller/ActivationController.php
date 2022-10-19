<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;



class ActivationController extends AbstractController
{
    #[Route('administrateur/activer/{id}', name: 'activer')]
    public function activer(User $user, EntityManagerInterface $entityManager): Response
    {
        $user->setActivated(($user->isActivated())?false:true);
        $entityManager->persist($user);
        $entityManager->flush($user);

        return new Response("true");
    }
}
