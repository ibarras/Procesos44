<?php

namespace App\Repository;

use App\Entity\IcTipoSolicitud;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcTipoSolicitud as EntityIcTipoSolicitud;

/**
 * @method IcTipoSolicitud|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcTipoSolicitud|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcTipoSolicitud[]    findAll()
 * @method IcTipoSolicitud[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcTipoSolicitudRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcTipoSolicitud::class);
    }


    public function transform(IcTipoSolicitud $solicitud)
    {
        return [
            'Id'                    => $solicitud->getId(),
            'Nombre'                => $solicitud->getNombre(),
        ];


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

    public function getAllSolicitudByType($perfil, $type = null, $flag = null)
    {
        $em = $this->getEntityManager();
        $q = $em->createQuery('
                SELECT a  FROM App\Entity\IcTipoSolicitud a
                WHERE a.idPerfilSolicita = :perfil
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
