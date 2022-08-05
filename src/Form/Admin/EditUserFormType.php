<?php

namespace App\Form\Admin;

use App\Entity\StaticStorage\UserStaticStorage;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('newEmail', TextType::class, [
                'label' => 'Email',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('plainPassword', TextType::class, [
                'label' => 'New password',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('fullName', TextType::class, [
                'label' => 'Full name',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Address',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('zipcode', TextType::class, [
                'label' => 'Zipcode',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Roles',
                'required' => false,
                'multiple' => true,
                'choices' => array_flip(UserStaticStorage::getUserStatusChoices()),
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('isDeleted', CheckboxType::class, [
                'label' => 'Is deleted',
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label_attr' => [
                    'class' => 'form-check-label'
                ]
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
