<?php

namespace App\Repository;

use App\Entity\IcCentroCosto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcCentroCosto as EntityIcCentroCosto;

/**
 * @method IcCentroCosto|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcCentroCosto|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcCentroCosto[]    findAll()
 * @method IcCentroCosto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcCentroCostoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcCentroCosto::class);
    }


    public function transform(IcCentroCosto $centro)
    {
        return [

            'id'            => $centro->getId(), 
            'nombre'        => $centro->getNombre(),
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

    /**
     * @param  $where = findOneBy(array $criteria, array $orderBy = null)
     * @param $toJson = boolean 
     * 
     */
    public function getFindByWhere($where, $toJson = null)
    {
        $qb = $this->createQueryBuilder('c')
		
        ->orderBy('c.id', 'DESC');
		
        if($where){

            $qb->andWhere('c.' . $where[0] . '= :parameter')->setParameter('parameter', $where[1]);
        }

        if($toJson)
        {
            $query =  $qb->getQuery();
            $result = $query->execute();

            $allArray = [];

            foreach ($result as $single) {
                $allArray[] = $this->transform($single);
            }
            return $allArray;
        }

        $query =  $qb->getQuery();
        return $query->execute();

    }



}
