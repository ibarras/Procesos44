<?php

namespace App\Repository;

use App\Entity\FosUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\FosUser as EntityFosUser;

/**
 * @method FosUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method FosUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method FosUser[]    findAll()
 * @method FosUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IcFosUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FosUser::class);
    }


    /**
     * @param EntityFosUser $user
     * @return array
     */
    public function transform(FosUser $user )
    {
        return [
            'Id'                    => $user->getId(),
            'Username'              => $user->getUsername(),
            'Email'                 => $user->getEmail(),
            'Enabled'               => $user->getEnabled(),
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function transformOne($id)
    {
        $object = $this->find($id);

        $o  = $this->transform($object);

        return $o;
    }

    /**
     * @param null $o
     * @return array
     */
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



}
