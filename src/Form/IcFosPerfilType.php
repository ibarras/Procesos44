<?php

namespace App\Form;

use App\Entity\IcFosPerfil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class IcFosPerfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                'label' => 'Nombre', 'attr'=> array('class' => 'form-control')
            ))
            ->add('apellido', TextType::class, array(
                'label' => 'Apellido', 'attr'=> array('class' => 'form-control')
            ))
            ->add('telefono', TextType::class, array(
                'label' => 'Teléfono', 'attr'=> array('class' => 'form-control')
            ))
            ->add('fechaIngreso',DateType::class,array(
                'label' => 'Fecha de Ingreso', 'widget' => 'single_text', 'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('idCentro', EntityType::class,
                array('class' => 'App\Entity\IcCentroTrabajo',
                    'label' => 'Centro de Trabajo','attr' => array('class' => 'form-control')
                ))
            ->add('idDireccion', EntityType::class,
                array( 'class' => 'App\Entity\IcDireccion',
                    'label' => 'Direccion', 'attr'=> array('class' => 'form-control')
                ))
            ->add('idGerencia', EntityType::class,
                array('class' => 'App\Entity\IcGerencia',
                    'label' => 'Gerencia', 'attr'=> array('class' => 'form-control')
                ))
            ->add('idPuesto', EntityType::class,
                array('class' => 'App\Entity\IcPuesto',
                    'label' => 'Puesto', 'attr' => array('class'=>'form-control')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IcFosPerfil::class,
        ]);
    }
}
