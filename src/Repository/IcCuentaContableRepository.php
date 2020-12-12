<?php

namespace App\Repository;

use App\Entity\IcCuentaContable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcCuentaContable as EntityIcCuentaContable;

/**
 * @method IcCuentaContable|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcCuentaContable|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcCuentaContable[]    findAll()
 * @method IcCuentaContable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcCuentaContableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcCuentaContable::class);
    }

    public function transform(IcCuentaContable $cuentaContable)
    {
        return [
            'id'    => (int)    $cuentaContable->getId(),
            'title' => (string) $cuentaContable->getTitle(),
            'count' => (int)    $cuentaContable->getCount()
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

    public function getCuentaContable($direccion)
    {

        $em = $this->getEntityManager();
        $query =  "
       select  distinct(ccon.nombre) as nombre, cc.nombre as centro, ccon.id as id
       from App\Entity\IcFosPerfil  p
       
        inner join App\Entity\IcCentroOrganizativoDireccion  co 
                    WITH  p.idDireccion = co.idDireccion
        inner join App\Entity\IcCentroCosto cc 
                    WITH co.id = cc.idCentroOrganizativo
        inner join App\Entity\IcCuentaContable ccon 
                    WITH cc.id = ccon.idCentroCosto
                    
        where p.idDireccion = " . $direccion;


        return $em->createQuery( $query )->getResult();

    }
}