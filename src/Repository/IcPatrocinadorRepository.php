<?php

namespace App\Repository;

use App\Entity\IcPatrocinador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IcPatrocinador|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcPatrocinador|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcPatrocinador[]    findAll()
 * @method IcPatrocinador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcPatrocinadorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcPatrocinador::class);
    }


    public function getAllPatrocinadores($usuario)
    {
        $em = $this->getEntityManager();
        $q = $em->createQuery('
                SELECT p FROM App\Entity\IcPatrocinador p
                WHERE p.idUsuario = :usuario
                ORDER BY p.id ASC
            ')->setParameter('usuario', $usuario);

        return $q->getResult();
    }

    /**
     * Retorna el total de patrocinadores por usuario
     * @param $usuario
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countPatrocinadores($usuario)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->SELECT('count(patrocinador)');
        $qb->FROM('App\Entity\IcPatrocinador', 'patrocinador');
        $qb->WHERE('patrocinador.idUsuario = :usuario');
        $qb->setParameter('usuario', $usuario);

        $count = $qb->getQuery()->getSingleScalarResult();

        return $count;
    }

    /**
     * Retorna el total de patrocinadores
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countAllPatrocinadores()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->SELECT('count(patrocinador)');
        $qb->FROM('App\Entity\IcPatrocinador', 'patrocinador');

        $count = $qb->getQuery()->getSingleResult();

        return $count;
    }

    // /**
    //  * @return IcPatrocinador[] Returns an array of IcPatrocinador objects
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
    public function findOneBySomeField($value): ?IcPatrocinador
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
