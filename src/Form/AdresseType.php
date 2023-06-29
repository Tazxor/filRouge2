<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => 'libelle',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre Libelle ici avec un minimum de 2 caractères.'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom(s)',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre Prénom ici avec un minimum de minimum de 2 caractères.'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom de famille',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre Nom ici avec un minimum de 2 caractères.'
                ]
            ])
            ->add('textAdresse', TextType::class, [
                'label' => 'Adresse',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre Adresse ici avec un minimum de 2 caractères.'
                ]
            ])

            ->add('societe', TextType::class, [
                'label' => 'Société',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre Société ici avec un minimum de 2 caractères.'
                ]
            ])

            ->add('phone', TelType::class, [
                'label' => 'Numéro de téléphone :',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre Numéro de mobile'
                ]
            ])
            ->add('cp', TextType::class, [
                'label' => 'Code postale',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre Code postale ici avec un minimum de 2 caractères.'
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre Ville ici avec un minimum de 2 caractères.'
                ]
            ])
            ->add('pays', CountryType::class, [
                'label' => 'Pays',
                'constraints' => new Length(2,2,35)

            ])
            ->add('envoyer', SubmitType::class, [
                'label' => "Enregistrer"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}

