<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder


            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom',
                'constraints' => new Length(min: 2, max: 30),
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'form-control'
                ]
            ])

            ->add('address', TextType::class, [
                'required' => true,
                'label' => 'Adresse',
                'constraints' => new Length(min: 2, max: 30),
                'attr' => [
                    'placeholder' => 'Ville',
                    'class' => 'form-control'
                ]
            ])

            ->add('roles', ChoiceType::Class, [
                'choices' => [
                    'administrateur' => 'ROLE_ADMINISTRATEUR',
                    'Partenaire' => 'ROLE_PARTENAIRE',
                    'Structure' => 'ROLE_STRUCTURE'
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Rôle'
            ])

            ->add('activated', CheckboxType::class, [
                'label' => 'Activer',
                'mapped' => false,
                'required' => false
            ])

            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Veuillez saisir un e-Mail',
                'constraints' => new Length(min: 2, max: 30),
                'attr' => [
                    'placeholder' => 'E-Mail',
                    'class' => 'form-control'
                ]
            ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'required' => true,
                'label' => 'Saisir un mot de passe',
                'attr' => [
                    'placeholder' => 'Mot de passe',
                    'autocomplete' => 'new-password',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saisir un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
