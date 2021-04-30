<?php


namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class ContactType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', TextType::class)
            ->add('message', TextareaType::class);
    }


    public function getDefaultOptions(array $options)
    {
        return array('data_class'=>'Acme\AccountBundle\Entity\User');
    }

    public function getName()
    {
        return 'user';
    }

}