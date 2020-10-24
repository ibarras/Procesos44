<?php

namespace App\Form;

use App\Entity\IcGerencia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IcGerenciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class,array(
                'label' => 'Nombre', 'attr' => array('class' => 'form-control')
            ))
            ->add('idDireccion', EntityType::class,
                array('class' => 'App\Entity\IcDireccion',
                    'label'=> 'Dirección',
                    'attr' => array('class' => 'form-control')
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IcGerencia::class,
        ]);
    }
}
