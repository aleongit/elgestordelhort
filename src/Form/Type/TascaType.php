<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\FormBuilderInterface;

class TascaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, 
                [   'label' => 'Títol: ',
                    'attr' => [ 'class' => 'form-control',
                                'placeholder' => 'Títol..'],
                    'row_attr' => [ 'class' => 'form-group md-6 mt-3']
                ])
            ->add('content', TextareaType::class,
                [   'label' => 'Contingut: ',
                    'attr' => [ 'class' => 'form-control',
                                'placeholder' => 'Contingut..'],
                    'row_attr' => [ 'class' => 'form-group md-6 mt-3']
                ])
            ->add('priority', ChoiceType::class,
                [   'label' => 'Prioritat: ',
                    'attr' => [ 'class' => 'form-control'],
                    'row_attr' => [ 'class' => 'form-group md-6 mt-3'],
                    'choices'  => [
                        'high' => 'high',
                        'medium' => 'medium',
                        'low' => 'low']
                ])
            ->add('hours', IntegerType::class,
                [   'label' => 'Hores: ',
                    'attr' => [ 'class' => 'form-control',
                                'placeholder' => 'Durada de la tasca'],
                    'row_attr' => [ 'class' => 'form-group md-6 mt-3']
                ])
            ->add('submit', SubmitType::class,
                [   'label' => "Crea Tasca!",
                    'attr' => [ 'class' => 'btn btn-primary mt-3']
                ])
        ;
    }
}