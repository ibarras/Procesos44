<?php

namespace App\Repository;

use App\Entity\IcTorneoCategoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcTorneoCategoria as EntityIcTorneoCategoria;

/**
 * @method IcTorneoCategoria|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcTorneoCategoria|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcTorneoCategoria[]    findAll()
 * @method IcTorneoCategoria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcTorneoCategoriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcTorneoCategoria::class);
    }


    public function transform(IcTorneoCategoria $class)
    {
        return [

            'id'            => $class->getId(), 
            'nombre'        => $class->getNombre(),
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
