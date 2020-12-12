<?php

namespace App\Repository;

use App\Entity\FosUser;
use App\Entity\FosUser as EntityFosUser;
use App\Entity\IcSolicitudSalidaActivos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IcSolicitudSalidaActivos|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcSolicitudSalidaActivos|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcSolicitudSalidaActivos[]    findAll()
 * @method IcSolicitudSalidaActivos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcSolicitudSalidaActivosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcSolicitudSalidaActivos::class);
    }



    public function transform(IcSolicitudSalidaActivos $class )
    {
        return [
            'Id'                    => $class->getId(),
            'Usuario'               => $class->getIdUsuario()->getUsername(),
            'UsuarioAutoriza'       => $class->getIdUsuarioAutoriza()->getUsername(),
            'FechaEntrada'          => $class->getFechaEntrada(),
            'FechaAutorizacion'     => $class->getFechaAutorizacion(),
            'Estatus'               => $class->getEstatus(),
            'CodigoAutorizacion'    => $class->getCodigoAutorizacion(),
            'IdActivoFijo'          => $class->getIdActivoFijo()->getId(),
            'Fecha'                 => $class->getFecha(),
        ];
    }

    public function transformAll($o = null)
    {
        $object = $this->findAll();

        $allArray = [];

        if($o)
            $object = $o;

        foreach ($object as $o) {
            $allArray[] = $this->transform($o);
        }

        return $allArray;
    }

    public function transformOne($id)
    {
        $object = $this->find($id);

        $o  = $this->transform($object);

        return $o;
    }

    public function getSolicitudes()
    {
        $em = $this->getEntityManager();

        $q = $em->createQuery('SELECT e FROM App:IcSolicitudSalidaActivos e 
        WHERE e.fecha_autorizacion <= CURRENT_DATE() 
        AND e.estatus = false');
        return $q->getResult();

    }





}
