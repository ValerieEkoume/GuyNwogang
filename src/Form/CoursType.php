<?php

namespace App\Form;

use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('title')
            ->add('description')
            ->add('prix')
            ->add('genre')
            ->add('niveau', ChoiceType::class, [
                'choices' =>$this->getChoices()
                ])
            ->add('createdAt')
            ->add('updatedAt')
            ->add('free')
            ->add('parts')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image (JPG or PNG file)',
                'required' => false,
                'allow_delete' => true,
                'delete_label' => '...',
                'download_label' => '...',
                'download_uri' => true,
                'image_uri' => true,
                'asset_helper' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
            'translation_domain' => 'forms'
        ]);
    }

    //Permet de gérer les options choix NIVEAU kops dans le form
    private function getChoices()
    {
       $choices =  Cours::NIVEAU;
       $output = [];
       foreach ($choices as $k => $v) {
           $output[$v] = $k;
       }
       return$output;
    }
}
