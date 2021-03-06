<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\CoursSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                    'label' => 'Prénom'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=> Contact::class


        ]);
    }
}

//class ContactType
//{
//    public function buildForm(FormBuilderInterface $builder, array $options)
//    {
//        $builder
//            ->add('firstname', TextType::class)
//            ->add('lastname', TextType::class)
//            ->add('email', TextType::class)
//            ->add('message', TextareaType::class);
//    }
//
//
//    public function getDefaultOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults([
//            'data_class'=> Contact::class]
//        );
//    }
//
//
//
//}