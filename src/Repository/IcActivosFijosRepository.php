<?php

namespace App\Repository;

use App\Entity\IcActivosFijos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcActivosFijosRepository as EntityIcActivosFijosRepository;

/**
 * @method IcActivosFijosRepository|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcActivosFijosRepository|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcActivosFijosRepository[]    findAll()
 * @method IcActivosFijosRepository[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcActivosFijosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcActivosFijos::class);
    }


    public function transform(IcActivosFijos $class)
    {
        return [

                'id'                    => $class->getId(),
                'id_usuario_area'       => $class->getIdUsuarioArea()->getUsername(),
                'id_usaurio_equipo'     => $class->getIdUsuarioEquipo()->getUsername(),
                'serie'                 => $class->getSerie(),
                'modelo'                => $class->getModelo(),
                'marca'                 => $class->getMarca(),
                'descripcion'           => $class->getDescripcion(),
                'ubicacion'             => $class->getUbicacion(),
                'nota'                  => $class->getNota(),
                'codigo_barras'         => $class->getCodigoBarras(),
                'estatus'               => $class->getEstatus(),

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
