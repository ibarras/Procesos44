<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class IcProcesosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idMacroprocesos', EntityType::class,
            array('class' => 'App\Entity\IcMacroprocesos',
                'label'=> 'Macroproceso',
                'attr' => array('class' => 'form-control')
            ))
            ->add('title',TextType::class, array(
                'label' => 'Nombre',
                'required' => true,
                'attr' => array('class' => 'form-control'
                )
            ))
            ->add('descripcion',TextareaType::class, array(
                'label' => 'Descripcion',
                'required' => true,
                'attr' => array('class' => 'form-control', 'rows'=> 10, 'cols' => 30
    )
            ))
            ->add('icImagen', FileType::class, array(
                'label' => 'Imagen de 200px x 200px',
                'required' => false,
                'attr' => array('class' => 'form-control'
                )
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
