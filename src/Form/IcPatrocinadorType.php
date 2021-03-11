<?php

namespace App\Form;

use App\Entity\IcPatrocinador;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IcPatrocinadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('idUsuario', EntityType::class,
                array('class' => 'App\Entity\FosUser',
                    'label' => 'Usuario',
                    'attr' => array('class' => 'form-control')
                ))*/
            ->add('nombre', TextType::class, array(
                'label' => 'Nombre o Razón Social',
                'attr' => array('class' => 'form-control')
            ))
            ->add('nombreComercial', TextType::class, array(
                'label' => 'Nombre Comercial',
                'attr' => array('class' => 'form-control')
            ))
            ->add('rfc', TextType::class, array(
                'label' => 'Nombre Comercial',
                'attr' => array('class' => 'form-control')
            ))
            ->add('correo', TextType::class, array(
                'label' => 'Correo de Contacto',
                'attr' => array('class' => 'form-control')
            ))
            ->add('IcLogo', FileType::class, array(
                'label' => 'Logo',
                'required' => false,
                'attr' => array('class' => 'custom-file-input')
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IcPatrocinador::class,
        ]);
    }
}
