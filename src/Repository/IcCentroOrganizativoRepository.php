<?php

namespace App\Repository;

use App\Entity\IcCentroOrganizativoDireccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcCentroOrganizativoDireccion as EntityIcCentroOrganizativoDireccion;

/**
 * @method IcCentroOrganizativoDireccion|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcCentroOrganizativoDireccion|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcCentroOrganizativoDireccion[]    findAll()
 * @method IcCentroOrganizativoDireccion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcCentroOrganizativoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcCentroOrganizativoDireccion::class);
    }


    public function transform(IcCentroOrganizativoDireccion $c)
    {
        return [

            'id'            => $c->getId(), 
            'nombre'        => $c->getNombre(),
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
