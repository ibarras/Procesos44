<?php


namespace App\Helpers;
use App\Entity\IcFosPerfil;
use App\Entity\FosUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

trait IcProfileTrait
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function profile()
    {
        if($this->security->getUser() instanceof FosUser) {
            return $this->entityManager->getRepository(IcFosPerfil::class)
                ->findOneBy(['idFos' => $this->security->getUser()]);
        }
    }

}