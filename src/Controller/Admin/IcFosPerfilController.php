<?php

namespace App\Controller\Admin;

use App\Entity\IcFosPerfil;
use App\Form\IcFosPerfilType;
use App\Repository\IcFosPerfilRepository;
use App\Repository\IcFosUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IcFosPerfilController extends AbstractController
{

//    public function index(): Response
//    {
//        $icFosPerfils = $this->getDoctrine()
//            ->getRepository(IcFosPerfil::class)
//            ->findAll();
//
//        return $this->render('admin/ic_fos_perfil/index.html.twig', [
//            'ic_fos_perfils' => $icFosPerfils,
//        ]);
//    }



    public function new(Request $request, IcFosUserRepository $fosUserRepository): Response
    {
        if(!$request->get('idPerfil')) {
            $this->addFlash('warning', 'Debe existir un usuario para agregar un perfil');
            return $this->redirectToRoute('procesos_usuarios');
        }

        $fos = $fosUserRepository->find($request->get('idPerfil'));

        $icFosPerfil = new IcFosPerfil();
        $form = $this->createForm(IcFosPerfilType::class, $icFosPerfil);
        $icFosPerfil->setIdFos($fos);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($icFosPerfil);
            $entityManager->flush();
            $this->addFlash('success', 'Perfil Agregado con exito');

            return $this->redirectToRoute('procesos_perfil');
        }

        return $this->render('admin/ic_fos_perfil/new.html.twig', [
            'ic_fos_perfil' => $icFosPerfil,
            'form' => $form->createView(),
            'fos'   => $fos,
        ]);
    }


    public function edit(Request $request, IcFosPerfilRepository $perfilRepository , $idPerfil): Response
    {

        $icFosPerfil = $perfilRepository->findOneBy(['idFos' => $idPerfil]);

        if(!$icFosPerfil) {
            $this->addFlash('warning', 'Usuario no existe');
            return $this->redirectToRoute('procesos_perfil_agregar', ['idPerfil' => $idPerfil]);
        }


        $form = $this->createForm(IcFosPerfilType::class, $icFosPerfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Cambio realizado con exito');
            return $this->redirectToRoute('procesos_perfil_modificar', array('idPerfil' => $icFosPerfil->getIdPerfil()));
        }

        return $this->render('admin/ic_fos_perfil/edit.html.twig', [
            'ic_fos_perfil' => $icFosPerfil,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, IcFosPerfil $icFosPerfil): Response
    {

        if ($this->isCsrfTokenValid('delete'.$icFosPerfil->getIdPerfil(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icFosPerfil);
            $entityManager->flush();
            $this->addFlash('success', 'Dado de baja  con exito');

        }

        return $this->redirectToRoute('procesos_perfil');
    }
}
