<?php

namespace App\Form;

use App\Entity\IcActivosFijos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IcActivosFijosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idUsuarioArea', EntityType::class,
                array('class' => 'App\Entity\FosUser',
                    'label' => 'Responsable de Area',
                    'attr' => array('class' => 'form-control')
                ))
            ->add('idUsuarioEquipo', EntityType::class,
                array('class' => 'App\Entity\FosUser',
                    'label' => 'Responsable de Equipo',
                    'attr' => array('class' => 'form-control')
                ))

            ->add('serie', TextType::class, array(
                'label' => 'Serie' , 'attr' => array('class'=>'form-control')
            ))
            ->add('modelo', TextType::class, array(
                'label' => 'Modelo' , 'attr' => array('class'=>'form-control')
            ))
            ->add('marca', TextType::class, array(
                'label' => 'Marca' , 'attr' => array('class'=>'form-control')
            ))
            ->add('descripcion', TextType::class, array(
                'label' => 'Descripcion' , 'attr' => array('class'=>'form-control')
            ))
            ->add('ubicacion', TextType::class, array(
                'label' => 'Ubicacion' , 'attr' => array('class'=>'form-control')
            ))
            ->add('nota', TextareaType::class, array(
                'label' => 'Nota' , 'attr' => array('class'=>'form-control')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IcActivosFijos::class,
        ]);
    }
}
