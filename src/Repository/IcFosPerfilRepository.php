<?php

namespace App\Repository;

use App\Entity\IcFosPerfil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\IcFosPerfil as EntityIcFosPerfil;

/**
 * @method IcFosPerfil|null find($id, $lockMode = null, $lockVersion = null)
 * @method IcFosPerfil|null findOneBy(array $criteria, array $orderBy = null)
 * @method IcFosPerfil[]    findAll()
 * @method IcFosPerfil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcFosPerfilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IcFosPerfil::class);
    }


    public function transform(IcFosPerfil $perfil)
    {
        return [
                'IdPerfil'  => $perfil->getIdPerfil(),
                'Apellido'  => $perfil->getApellido(),
                'Nombre'    => $perfil->getNombre(),
                'Telefono'  => $perfil->getTelefono(),
                'Direccion' => $perfil->getIdDireccion(),
                'Gerencia'  => $perfil->getIdGerencia(),
                'Area'      => $perfil->getIdArea(),
                'Puesto'    => $perfil->getIdPuesto(),
                'FIngreso'  => $perfil->getFechaIngreso(),
                'Nacimiento'   => $perfil->getFechaNacimiento(),
                'Rfc'       => $perfil->getRfc(),
                'Curp'      => $perfil->getCurp(),
                'Nss'       => $perfil->getNss(),
                'Profesion' => $perfil->getProfesion(),
                'Estatus'   => $perfil->getEstatus(),
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

    public function getAllSolicitudByType($perfil, $type = null, $flag = null)
    {
        $em = $this->getEntityManager();
        $q = $em->createQuery('
                SELECT a  FROM App\Entity\IcSolicitud a
                WHERE a.idPerfilSolicita = :perfil
                AND   a.idTipoSolicitud = :type
                ORDER BY a.id DESC 
            ')->setParameter('perfil', $perfil)->setParameter('type', $type);

            if($flag)
            {
                $solicitudes = $q->getResult();

                $solicitudesArray = [];

                foreach ($solicitudes as $solicitud) {
                    $solicitudesArray[] = $this->transform($solicitud);
                }
                return $solicitudesArray;
            }

        return $q->getResult();
    }



}
