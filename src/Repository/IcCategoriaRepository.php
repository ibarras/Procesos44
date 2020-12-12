<?php

namespace App\Repository;

use App\Entity\IcCategoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcCategoria as EntityIcCategoria;

/**
 * @method IcCategoria|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcCategoria|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcCategoria[]    findAll()
 * @method IcCategoria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcCategoriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcCategoria::class);
    }


    public function transform(IcCategoria $class)
    {
        return [
            'Id'                    => $class->getId(),
            'Torneo'                => $class->getIdTorneo()->getNombre(),
            'Jornada'               => $class->getIdJornada()->getNombre(),

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
