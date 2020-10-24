<?php

namespace App\Form;

use App\Entity\IcCentroTrabajo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class IcCentroTrabajoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                'label' => 'Nombre', 'attr' => array('class' => 'form-control')
            ))
            ->add('direccion', TextType::class, array(
                'label' => 'Dirección', 'attr' => array('class' => 'form-control')
            ))
            ->add('correo', EmailType::class, array(
                'label' => 'Correo Electrónico', 'attr' => array('class' => 'form-control')
            ))
            ->add('telefono', TextType::class,array(
                'label' => 'Teléfono', 'attr' => array('class' => 'form-control')
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IcCentroTrabajo::class,
        ]);
    }
}
