<?php

namespace App\Repository;

use App\Entity\IcDireccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcDireccion as EntityIcDireccion;

/**
 * @method IcDireccion|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcDireccion|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcDireccion[]    findAll()
 * @method IcDireccion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcDireccionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcDireccion::class);
    }


    public function transform(IcDireccion $direccion)
    {
        return [

            'id'            => $direccion->getIdDireccion(),
            'nombre'        => $direccion->getNombre(),
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
        try{
            $qb = $this->createQueryBuilder('c')

                ->orderBy('c.idDireccion', 'DESC');

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

        }catch (\Exception $exception){

        }
}   }
