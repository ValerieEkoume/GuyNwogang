<?php

namespace App\Form;

use App\Entity\CoursSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('genre', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Par genre'
                ]
            ])
            ->add('niveau', TextType::class, [
            'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Quelle est votre niveau ?'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CoursSearch::class,
            'method' => 'get',
            'csrf_protection' => false,

        ]);
    }
}
