<?php

namespace App\Form;

use App\Entity\Owner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OwnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Civilité' => 'Civilité',
                    'Monsieur' => 'Monsieur',
                    'Madame' => 'Madame'
                ],
                'empty_data' => 'Civilité'
            ])
            ->add('lastName', null, [
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('firstName', null, [
                'attr' => [
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('email', null, [
                'attr' => [
                    'placeholder' => 'email'
                ]
            ])
            ->add('phoneNumber', null, [
                'attr' => [
                    'placeholder' => 'Téléphone'
                ]
            ])
            ->add('addressLine1', null, [
                'attr' => [
                    'placeholder' => 'Adresse'
                ]
            ])
            ->add('addressLine2', null, [
                'attr' => [
                    'placeholder' => 'Complément d\'adresse'
                ]
            ])
            ->add('city', null, [
                'attr' => [
                    'placeholder' => 'Ville'
                ]
            ])
            ->add('postCode', null, [
                'attr' => [
                    'placeholder' => 'Code postal'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Owner::class,
        ]);
    }
}
