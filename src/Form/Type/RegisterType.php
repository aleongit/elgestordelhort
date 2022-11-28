<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, 
                [   'label' => 'Nom: ',
                    'attr' => [ 'class' => 'form-control',
                                'placeholder' => 'El teu nom'],
                    'row_attr' => [ 'class' => 'form-group md-6 mt-3']
                ])
            ->add('surname', TextType::class,
                [   'label' => 'Cognoms: ',
                    'attr' => [ 'class' => 'form-control',
                                'placeholder' => 'Els dos cognoms'],
                    'row_attr' => [ 'class' => 'form-group md-6 mt-3']
                ])
            ->add('email', TextType::class,
                [   'label' => 'Mail: ',
                    'attr' => [ 'class' => 'form-control',
                                'placeholder' => 'mail@valid.com'],
                    'row_attr' => [ 'class' => 'form-group md-6 mt-3']
                ])
            ->add('password', PasswordType::class,
                [   'label' => 'Contrasenya: ',
                    'attr' => [ 'class' => 'form-control',
                                'placeholder' => 'Pensa una bona!'],
                    'row_attr' => [ 'class' => 'form-group md-6 mt-3']
                ])
            ->add('submit', SubmitType::class,
                [   'label' => "Registra't!",
                    'attr' => [ 'class' => 'btn btn-primary mt-3']
                ])
        ;
    }
}