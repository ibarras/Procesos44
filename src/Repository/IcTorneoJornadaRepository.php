<?php

namespace App\Repository;

use App\Entity\IcTorneoJornada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcTorneoJornada as EntityIcTorneoJornada;

/**
 * @method IcTorneoJornada|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcTorneoJornada|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcTorneoJornada[]    findAll()
 * @method IcTorneoJornada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcTorneoJornadaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcTorneoJornada::class);
    }


    public function transform(IcTorneoJornada $class)
    {
        return [
            'Id'                    => $class->getId(),
            'Nombre'               => $class->getNombre(),

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
                SELECT a  FROM App\Entity\IcSolicitud a
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
