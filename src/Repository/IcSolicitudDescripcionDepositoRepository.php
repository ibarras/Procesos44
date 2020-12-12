<?php

namespace App\Repository;

use App\Entity\IcSolicitudDescripcion;
use App\Entity\IcSolicitudDescripcionDeposito;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcSolicitudDescripcionDeposito as EntityIcSolicitudDescripcionDeposito;

/**
 * @method IcSolicitudDescripcionDeposito|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcSolicitudDescripcionDeposito|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcSolicitudDescripcionDeposito[]    findAll()
 * @method IcSolicitudDescripcionDeposito[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcSolicitudDescripcionDepositoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcSolicitudDescripcionDeposito::class);
    }


    public function transform(IcSolicitudDescripcionDeposito $solicitud)
    {
        return [
            'Id'                        => $solicitud->getId(),
            'Beneficiario'              => $solicitud->getBeneficiario(),
            'Banco'                     => $solicitud->getBanco(),
            'Cuenta'                    => $solicitud->getCuenta(),
            'CuentaContable'            => $solicitud->getIdSolicitudDescripcion()->getIdCuentaContable()->getNombre(),
            'TipoGasto'                 => $solicitud->getTipoGasto(),
            'Cantidad'                  => $solicitud->getCantidad(),
            'Fecha'                     => $solicitud->getFecha(),
            'IdSolicitudDescripcion'    => $solicitud->getIdSolicitudDescripcion()->getId(),
            'EsActivo'                  => $solicitud->getEsActivo()

        ];


    }

    public function oneTransform($id)
    {
        $object = $this->find($id);

        $o  = $this->transform($object);

        return $o;
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

    public function getAllSolicitudByType($perfil, $type = null, $flag = null)
    {
        $em = $this->getEntityManager();
        $q = $em->createQuery('
                SELECT a  FROM App\Entity\IcSolicitudDescripcionDeposito a
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


    /**
     * @param $descripcion_array
     */
    public function getDepositos($descripcion_array){
        $em = $this->getEntityManager();
        $q = $em->createQuery('
                SELECT a  FROM App\Entity\IcSolicitudDescripcionDeposito a
                WHERE a.idSolicitudDescripcion IN (:descripcion)
                ORDER BY a.id DESC 
            ')->setParameter('descripcion', $descripcion_array);

            return $q->getResult();
    }



}
