<?php

namespace App\Repository;

use App\Entity\IcSolicitudDescripcion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcSolicitudDescripcion as EntityIcSolicitudDescripcion;

/**
 * @method IcSolicitudDescripcion|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcSolicitudDescripcion|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcSolicitudDescripcion[]    findAll()
 * @method IcSolicitudDescripcion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class  IcSolicitudDescripcionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcSolicitudDescripcion::class);
    }



    public function transform(IcSolicitudDescripcion $solicitud)
    {
        return [
            'id'                    => $solicitud->getId(),
            'cuenta'      => $solicitud->getIdCuentaContable()->getNombre(),
            'descripcion'           => $solicitud->getDescripcion(),
            'tipoDeGasto'           => $solicitud->getTipoDeGasto(),
            'presupuesto'           => $solicitud->getPresupuesto(),
            'precio_real'            => $solicitud->getPrecioReal(),
            'variacion'             => ($solicitud->getPresupuesto() - $solicitud->getPrecioReal()),
            'total'                 => $solicitud->getTotal(),
            'deposito'              => $solicitud->getDeposito(),
//            'Salddo'                => $solicitud->getSaldo(),
//            'RetirarSaldo'          => $solicitud->getRetirarSaldo(),
//            'Observaciones'         => $solicitud->getObservaciones(),
//            'IdSolicitud'           => $solicitud->getIdSolicitud(),
            'EsActivo'              => $solicitud->getEsActivo(),
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

    public function oneTransform($id)
    {
        $object = $this->find($id);

        $o  = $this->transform($object);

        return $o;
    }

    public function getAllSolicitudByType($perfil, $type = null, $flag = null)
    {
        $em = $this->getEntityManager();
        $q = $em->createQuery('
                SELECT a  FROM App\Entity\IcSolicitudDescripcion a
                WHERE a.idUsuarioSolicita = :perfil
                AND   a.idTipoSolicitud = :type
                ORDER BY a.id DESC 
            ')->setParameter('perfil', $perfil)->setParameter('type', $type);

            if($flag)
            {
                $solicitudes = $q->getResult();

                $solicitudesArray = [];

                foreach ($solicitudes as $solicitud) {
                    $solicitudesArray[] = $this->transform($solicitud);
                }
                return $solicitudesArray;
            }

        return $q->getResult();
    }



}
