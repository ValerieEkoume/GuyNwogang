<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
          ->add('username', TextType::class, [
          'label' => "Nom d'utilisateur"
          ])

          ->add('email', EmailType::class, [
              'attr' =>[
                  'placeholder' => "Un email de confirmation vous sera envoyé"
              ],
              'label' => "Email",

          ])

          ->add('password', PasswordType::class, [
            'label' => "Mot de Passe"
          ])


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