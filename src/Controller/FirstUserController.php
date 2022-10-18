<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegistrationFormType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FirstUserController extends AbstractController
{
    #[Route('firstUser', name: 'app_first_creation')]
    public function firstUser(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {



        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles(['ROLE_ADMINISTRATEUR']);

            $entityManager->persist($user);
            $entityManager->flush();


            // TODO send an email
                        // Sending mail
/*                         $partnerMail = $partner->getEmail();
                        $email = (new TemplatedEmail())
                            ->from('brunod.dev@gmail.com')
                            ->to($partnerMail)
                            ->subject('Création de votre compte SportClub - '.(new \DateTime())->format('d m Y'))
                            ->htmlTemplate('mail/creationPartnerAccountMail.html.twig')
                            ->context([
                                'newsletter_date' => new \DateTime(),
                                'partner' => $partner,
                            ])
                        ;
                        $mailer->send($email);
 */

            return $this->redirectToRoute('app_login');
        }

        return $this->render('pages/creation.html.twig', [
            'registrationForm' => $form->createView(),
            'pageName' => 'premiere creation',
            'userToCreate' => 'administrateur',

        ]);
    }
}
