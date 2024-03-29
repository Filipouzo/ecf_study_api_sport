<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Option;
use App\Entity\GlobalOption;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class ActivationController extends AbstractController
{
    #[Route('administrateur/activerUser/{id}', name: 'activer')]
    public function activer(User $user, EntityManagerInterface $entityManager): Response
    {
        $user->setActivated(($user->isActivated())?false:true);
        $entityManager->persist($user);
        $entityManager->flush($user);

        return new Response("true");
    }

    #[Route('administrateur/activerGlobalOption/{id}', name: 'activerGlobalOption')]
    public function activerglobalOption(GlobalOption $globalOption, EntityManagerInterface $entityManager): Response
    {
        $globalOption->setActivated(($globalOption->isActivated()) ? false : true);
        $entityManager->persist($globalOption);
        $entityManager->flush($globalOption);

        return new Response("true");
    }

    #[Route('administrateur/activerOption/{id}', name: 'activerOption')]
    public function activerOption(Option $Option, EntityManagerInterface $entityManager): Response
    {
        $Option->setActivated(($Option->isActivated()) ? false : true);
        $entityManager->persist($Option);
        $entityManager->flush($Option);

        return new Response("true");
    }
}
