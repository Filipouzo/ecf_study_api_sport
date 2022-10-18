<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\AdministatorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CreationController extends AbstractController
{
    #[Route('{userToAdmin}/creation', name: 'administrateur_creation')]
    public function creation(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, $userToAdmin): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            dd ($form);
            // encode the plain password
/*             $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );    */
            
            // encode random password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    random_bytes(10)
                )
            );


            $user->setActivated('true');

            	// TODO  setParent   faire la gestion du parent                
                    //if(isset($parent)){}


            if ($userToAdmin == 'administrateur'){
                $user->setRoles(["ROLE_ADMINISTRATEUR"]);
            }
            elseif ($userToAdmin == 'partenaire'){
                $user->setRoles(["ROLE_PARTENAIRE"]);
            }
            elseif ($userToAdmin == 'structure'){
                $user->setRoles(["ROLE_STRUCTURE"]);
            }

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            // TODO Redirection vers la liste à corriger
            return $this->redirectToRoute('administrateur_liste', array('userToAdmin' => $userToAdmin));
        }

        return $this->render('pages/creation.html.twig', [
            'registrationForm' => $form->createView(),
            'pageName' => 'créer '.$userToAdmin,
            'userToCreate' => $userToAdmin,

        ]);
    }
}
