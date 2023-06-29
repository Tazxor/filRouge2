<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\Length;

class UpdateCompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de famille',
                'constraints' => new Length(2, 2, 35)

            ])
            ->add(
                'prenom',
                TextType::class,
                [
                    'label' => 'Prénom(s)',
                    'constraints' => new Length(2, 2, 35)
                ]
            )
            ->add('DateNaissance', DateType::class, [
                'label' => 'date de naissance',
                'years' => range(1920, 2010),
                'format' => 'dd-MM-yyyy'
            ])
            ->add(
                'mobile',
                TelType::class,
                [
                    'label' => 'Numéro de téléphone :',
                    'constraints' => new Length(2, 2, 35)
                ]
            )
           
            ->add('oddPassword', PasswordType::class, [
                'label' => 'Mot de passe actuel',
                'mapped'=>false,//non-repartorie dans entity User
                'required' => true                    
                ])



            ->add('newPassword', RepeatedType::class, [
                'label' => 'Mot de passe',
                'mapped'=>false,
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe confirmation non valide',
                'required' => true,
                'first_options' => [
                    'label' => 'nouveau mot de passe',
                    'attr'=>['placeholder' => 'nouveau le mot de passe']
                    
                ],
                'second_options' => [
                    'label' => 'confimation du nouveau le mot de passe',
                    'attr'=>['placeholder' => 'confimation du nouveau le mot de passe']
                    
                ],
    
                
            ])
            ->add('envoyer', SubmitType::class, [
                'label' => "Modifier"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
