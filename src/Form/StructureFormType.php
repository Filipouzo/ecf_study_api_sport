<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class StructureFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('address', TextType::class, [
                'required' => true,
                'label' => 'Adresse',
                'constraints' => new Length(min: 2, max: 30),
                'attr' => [
                    'placeholder' => 'Adresse de la structure',
                    'class' => 'form-control'
                ]
                ])

            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'E-mail',
                'constraints' => new Length(min: 2, max: 30),
                'attr' => [
                    'placeholder' => 'E-mail',
                    'class' => 'form-control'
                ]
            ])

            ->add('parent', HiddenType::class, [
                'mapped' => false
            ])

            ->add('password', HiddenType::class, [
                'mapped' => false
            ])
            ->add('roles', HiddenType::class, [
                'mapped' => false
            ])

/*             ->add('enrgistrer', SubmitType::class, [
                'label' => 'Enregister'
            ]) */;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

