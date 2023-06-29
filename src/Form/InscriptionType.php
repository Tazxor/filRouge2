<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de famille',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre Nom ici avec un minimum de 2 caractères.'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom(s)',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre Prénom ici avec un minimum de minimum de 2 caractères.'
                ]
            ])
            ->add('DateNaissance', DateType::class, [
                'label' => 'date de naissance',
                'years' => range(1920,2010),
                'format' => 'dd-MM-yyyy'
            ])
            ->add('mobile', TelType::class, [
                'label' => 'Numéro de téléphone :',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre Numéro de mobile'
                ]
] )
            ->add('email', EmailType::class, [
                'label' => 'E-mail :',

                'attr' => [
                    'placeholder' => 'Saisir votre adresse email valide !'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'label' => 'Mot de passe',
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe confirmation non valide',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => ['placeholder' => 'saisir mot de passe ']
                ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe',
                    'attr' => ['placeholder' => 'saisir confirmation mot de passe ']
                ]

            ])
            ->add('envoyer', SubmitType::class, [
                'label' => "S'inscrire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}