<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreationController extends AbstractController
{
    #[Route('administrateur/{userToAdmin}/creation', name: 'administrateur_creation')]
    public function creation(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserRepository $users, EntityManagerInterface $entityManager, $userToAdmin): Response
    {
        $parentId = $request->query->get('parentId');
        $parentName = $request->query->get('parentName');

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $temporaryPasseword = random_bytes(10);

            // encode random password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $temporaryPasseword
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
                $parentwithid = $users->findOneById($parentId);
                $user->setParent($parentwithid);
            }

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            // TODO Redirection vers la liste à corriger
            return $this->redirectToRoute('administrateur_liste', array('userToAdmin' => $userToAdmin, 'parentId' => $parentId, 'parentName' => $parentName));
        }
        
        return $this->renderForm('pages/creation.html.twig', [
            'registrationForm' => $form,
            'pageName' => 'créer '.$userToAdmin,
            'userToCreate' => $userToAdmin,
        ]);
    }
}
