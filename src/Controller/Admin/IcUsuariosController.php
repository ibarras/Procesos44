<?php

namespace App\Controller\Admin;

use App\Entity\FosUser;
use App\Repository\IcFosUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IcUsuariosController extends AbstractController
{

    public function index(IcFosUserRepository $UserRepository )
    {

        $users = $UserRepository->transformAll();
        return $this->render('admin/ic_usuarios/index.html.twig', [
            'users' => $users,
        ]);
    }
}
