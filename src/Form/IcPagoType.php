<?php

namespace App\Form;

use App\Entity\IcPago;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IcPagoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('monto', TextType::class, array(
                'label' => 'Monto',
                'attr' => array('class' => 'form-control')
            ))
            ->add('IcComprobante', FileType::class, array(
                'label' => 'Comprobante de Pago',
                'required' => false,
                'attr' => array('class' => 'custom-file-input')

            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IcPago::class,
        ]);
    }
}
