<?php

namespace App\Repository;

use App\Entity\IcDocumentosPerfil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcDocumentosPerfil as EntityIcDocumentosPerfil;

/**
 * @method IcDocumentosPerfilRepository|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcDocumentosPerfilRepository|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcDocumentosPerfilRepository[]    findAll()
 * @method IcDocumentosPerfilRepository[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcDocumentosPerfilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcDocumentosPerfil::class);
    }


    public function transform(IcDocumentosPerfil $class)
    {
        return [

            'Id'                           => $class->getId(),
            'Cv'                           => $class->getCv(),
            'Acta_Nacimiento'               => $class->getActaNacimiento(),
            'Comprobante_Domicilio'         => $class->getComprobanteDomicilio(),
            'Comprobante_Estuddios'         => $class->getComprobanteEstudios(),
            'Credencial_Elector'            => $class->getCredencialElector(),
            'Cartas_Recomendacion'          => $class->getCartasRecomendacion(),
            'Fotografia'                   => $class->getFotografia(),
            'Carta_No_Antecedentes_Penales'   => $class->getCartaNoAntecedentesPenales(),
            'Id_Perfil'                     => $class->getIdPerfil(),
            'Prueba_Laboratorio'            => $class->getPruebaLaboratorio(),

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
