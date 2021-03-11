<?php

namespace App\Form;

use App\Entity\IcPagoProyectado;
use App\Entity\IcPatrocinador;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IcPagoProyectadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idPatrocinador', EntityType::class, array(
                'class' => 'App\Entity\IcPatrocinador',
                'placeholder' => 'Selecciona un Patrocinador',
                'attr' => array('class' => 'browser-default custom-select')
            ))
            ->add('fechaPagoProyectado', DateType::class, array(
                'widget' => 'single_text',
                'attr' => array('class' => 'form-control')
            ))
            ->add('fechaLimitePago', DateType::class, array(
                'widget' => 'single_text',
                'attr' => array('class' => 'form-control')
            ))
            ->add('monto', TextType::class, array(
                'label' => 'Cantidad a Pagar',
                'attr' => array('class' => 'form-control')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IcPagoProyectado::class,
        ]);
    }
}
