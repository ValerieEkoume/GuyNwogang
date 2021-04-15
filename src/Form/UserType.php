<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
          ->add('username', TextType::class)
          ->add('email', TextType::class)
          ->add('password', TextType::class)

        ;
    }


    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Acme\AccountBundle\Entity\User');
    }

    public function getName()
    {
        return 'user';
    }
}