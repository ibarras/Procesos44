<?php

namespace App\Repository;

use App\Entity\IcSolicitud;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcSolicitud as EntityIcSolicitud;

/**
 * @method IcSolicitud|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcSolicitud|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcSolicitud[]    findAll()
 * @method IcSolicitud[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcSolicitudRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcSolicitud::class);
    }


    public function transform(IcSolicitud $solicitud)
    {
        return [
            'Id'                    => $solicitud->getId(),
            'Perfil'                => $solicitud->getIdUsuarioSolicita()->getUsername(),

            'PerfilAutoriza'        => ( $solicitud->getIdUsuarioAutoriza() == null )? 'Sin Autorizacion':
                                            $solicitud->getIdUsuarioAutoriza()->getUsername(),

            'Torneo'                => $solicitud->getIdTorneo()->getNombre(),
            'Categoria'             => $solicitud->getIdTorneoCategoria()->getNombre(),
            'CentroCosto'           => $solicitud->getIdCentroCosto()->getNombre(),
            'Jornada'               => $solicitud->getIdJornada()->getNombre(),
            'Direccion'             => $solicitud->getIdDireccion()->getNombre(),
            'TorneoCategoria'       => $solicitud->getIdTorneoCategoria()->getNombre(),

            'CentroOrganizativo'    => ($solicitud->getIdCentroOrganizativo() == null )? 'Sin CO':
                                             $solicitud->getIdCentroOrganizativo()->getNombre(),

            'TipoSolicitud'         => $solicitud->getIdTipoSolicitud()->getNombre(),
            'Fecha'                 => date_format($solicitud->getFecha(), 'd/M/Y'),
            'FechaTransferencia'    => $solicitud->getFechaTransferencia(),
            'FormaDePago'           => $solicitud->getFormaDePago(),
            'NumeroTarjeta'         => $solicitud->getNumeroTarjeta(),
            'MotivoDeGasto'         => $solicitud->getMotivoDeGasto(),
            'informe'               => $solicitud->getInforme(),
            'Importe'               => $solicitud->getImporte(),

        ];


    }

    public function oneTransform($id)
    {
        $object = $this->find($id);

        $o  = $this->transform($object);

        return $o;
    }

    public function transformAll()
    {
        $object = $this->findAll();

        $allArray = [];

        foreach ($object as $o) {
            $allArray[] = $this->transform($o);
        }

        return $allArray;
    }

    /**
     * @param $tipo_solicitud
     * @param null $bool si se recive un valor [true] se retornara formateado tipo array asociativo
     * @return array|int|mixed|string
     */
    public function getSolicitudesPorTipo($tipo_solicitud , $bool = null)
    {
        $em = $this->getEntityManager();
        $q = $em->createQuery('
                SELECT a  FROM App\Entity\IcSolicitud a
                AND   a.idTipoSolicitud = :tipo_solicitud
                ORDER BY a.id DESC 
            ')->setParameter('tipo_solicitud', $tipo_solicitud);

        if($bool){
            $solicitudes = $q->getResult();

            $solicitudesArray = [];

            foreach ($solicitudes as $solicitud) {
                $solicitudesArray[] = $this->transform($solicitud);
            }
            return $solicitudesArray;
        }

        return $q->getResult();
    }

    public function getAllSolicitudByType($usuario, $type = null, $flag = null)
    {
        $em = $this->getEntityManager();
        $q = $em->createQuery('
                SELECT a  FROM App\Entity\IcSolicitud a
                WHERE a.idUsuarioSolicita = :usuario
                AND   a.idTipoSolicitud = :type
                ORDER BY a.id DESC 
            ')->setParameter('usuario', $usuario)->setParameter('type', $type);

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
