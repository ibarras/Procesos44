<?php

namespace App\Repository;

use App\Entity\IcPagoProyectado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use PDO;

/**
 * @method IcPagoProyectado|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcPagoProyectado|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcPagoProyectado[]    findAll()
 * @method IcPagoProyectado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcPagoProyectadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcPagoProyectado::class);
    }

    public function pagosProyectadosUsuario($usuario)
    {
        $qb = $this->createQueryBuilder('pp');

        $qb
            ->innerJoin('App\Entity\IcPatrocinador', 'p', Join::WITH, 'p = pp.idPatrocinador')
            ->where('p.idUsuario = :username')
            ->setParameter('username', $usuario)
            ->orderBy('pp.id')
        ;

        //dump($qb->getQuery()->getResult());

        return $qb->getQuery()->getResult();
    }

    public function montoTotalProyectado($usuario)
    {
        $qb = $this->createQueryBuilder('pp');

        $qb
            ->select('sum(pp.monto)')
            ->innerJoin('App\Entity\IcPatrocinador', 'p', Join::WITH, 'p = pp.idPatrocinador')
            ->where('p.idUsuario = :username')
            ->setParameter('username', $usuario)
            ;

        //dump($qb->getQuery()->getScalarResult());

        $suma = $qb->getQuery()->getSingleScalarResult();

        return $suma;
    }

    public function getPagosproyectadosMes($inicial, $final)
    {
        $qb = $this->createQueryBuilder('pp');

        $qb
            ->where('pp.fechaPagoProyectado >= :inicial')
            ->andWhere('pp.fechaPagoProyectado <= :final')
            ->setParameter('inicial', $inicial)
            ->setParameter('final',$final)
        ;

        $pagosProyectados = $qb->getQuery()->getResult();

        return $pagosProyectados;
    }

    /**
     * retorna todos los pagos proyectados del año en curso
     * @return mixed
     */
    public function getPagosProyectadosAnio()
    {
        //primer y ultimo dia del año actual
        $year_start_day = date('Y-m-d', strtotime('first day of January this year', time()));
        $year_end_day = date('Y-m-d', strtotime('last day of December this year', time()));

        $qb = $this->createQueryBuilder('pp');

        $qb
            ->where('pp.fechaPagoProyectado >= :first_day')
            ->andWhere('pp.fechaPagoProyectado <= :last_day')
            ->setParameter('first_day', $year_start_day)
            ->setParameter('last_day', $year_end_day);

        $pagosProyectados = $qb->getQuery()->getResult();

        return $pagosProyectados;
    }

    public function transform(IcPagoProyectado $class)
    {
        return [

            'id'                    => $class->getId(),
            'id_patrocinador'       => $class->getIdPatrocinador()->getNombreComercial(),
            'fecha_proyectado'      => date_format($class->getFechaPagoProyectado(), 'd/M/Y'),
            'fecha_limite'          => date_format($class->getFechaLimitePago(),'d/M/Y'),
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
    //  * @return IcPagoProyectado[] Returns an array of IcPagoProyectado objects
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
    public function findOneBySomeField($value): ?IcPagoProyectado
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
