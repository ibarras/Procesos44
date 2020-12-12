<?php

namespace App\Form;

use App\Entity\IcDocumentosPerfil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IcDocumentosPerfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cv')
            ->add('actaNacimiento')
            ->add('comprobanteDomicilio')
            ->add('comprobanteEstudios')
            ->add('credencialElector')
            ->add('cartasRecomendacion')
            ->add('fotografia')
            ->add('cartaNoAntecedentesPenales')
            ->add('pruebaLaboratorio')
            ->add('idPerfil')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IcDocumentosPerfil::class,
        ]);
    }
}
