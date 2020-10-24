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
        $cuentaContable = $this->findAll();
        $cuentaContableArray = [];

        foreach ($cuentaContable as $cc) {
            $cuentaContableArray[] = $this->transform($cc);
        }

        return $cuentaContableArray;
    }


    /**
     * Metodo para obtener Actual
     *
     */
    public function getTecnicoActivo()
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('
				SELECT ct FROM FrontendBundle:IcCuerpoTecnico ct
				WHERE ct.esActivo = true
				AND   ct.esEntrenador = true
				');

        return $query->getOneOrNullResult();
    }



}