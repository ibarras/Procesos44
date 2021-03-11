<?php

namespace App\Repository;

use App\Entity\IcPago;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IcPago|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcPago|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcPago[]    findAll()
 * @method IcPago[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcPagoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcPago::class);
    }

    public function transform(IcPago $class)
    {
        return [

            'id'                    => $class->getId(),
            'id_pago_proyectado'    => $class->getIdPagoProyectado()->getIdPatrocinador()->getNombreComercial(),
            'fecha'      => date_format($class->getFecha(), 'd/M/Y'),
            'monto'                 => intval($class->getMonto()),

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

    // /**
    //  * @return IcPago[] Returns an array of IcPago objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IcPago
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
