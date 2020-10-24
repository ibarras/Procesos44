<?php

namespace App\Form;

use App\Entity\IcInstruccionTrabajo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class IcInstruccionTrabajoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, array(
                'label' => 'Nombre del Instructivo de Trabajo',
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
            ->add('IcImagen',FileType::class, array(
                'label' => 'Imagen',
                'required' => false,
                'attr' => array('class' => 'form-control'
                )
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IcInstruccionTrabajo::class,
        ]);
    }
}
