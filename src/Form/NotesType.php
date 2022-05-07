<?php

namespace App\Form;

use App\Entity\Notes;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NotesType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array (
                'required' => FALSE,
                'label' => FALSE,
            ))
            ->add('description', TextareaType::class, array (
                'label' => FALSE,
            ))
            ->add('status', ChoiceType::class, array (
                'choices' => array (
                    'ACTIVE' => TRUE,
                    'INACTIVE' => FALSE,
                ),
                'label' => FALSE,
            ))
            ->add('category', ChoiceType::class, array (
                'choices' => array (
                    'Категория 1' => 1,
                    'Категория 2' => 2,
                    'Категория 3' => 3,
                    'Категория 4' => 4,
                ),
                'label' => FALSE,
            ))
            ->add('created', DateTimeType::class, array (
                'label' => FALSE,
            ))
            ->add('submit', SubmitType::class);
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notes::class,
        ]);
    }
}
