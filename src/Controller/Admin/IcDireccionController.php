<?php

namespace App\Controller\Admin;

use App\Entity\IcDireccion;
use App\Form\IcDireccionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IcDireccionController extends AbstractController
{

    public function index(): Response
    {
        $icDireccions = $this->getDoctrine()
            ->getRepository(IcDireccion::class)
            ->findAll();

        return $this->render('admin/ic_direccion/index.html.twig', [
            'ic_direccions' => $icDireccions,
        ]);
    }


    public function new(Request $request): Response
    {
        $icDireccion = new IcDireccion();
        $form = $this->createForm(IcDireccionType::class, $icDireccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($icDireccion);
            $entityManager->flush();
            $this->addFlash('success', 'Elemento agregado con exito');

            return $this->redirectToRoute('ic_direccion_index');
        }

        return $this->render('admin/ic_direccion/new.html.twig', [
            'ic_direccion' => $icDireccion,
            'form' => $form->createView(),
        ]);
    }


    public function edit(Request $request, IcDireccion $icDireccion): Response
    {
        $form = $this->createForm(IcDireccionType::class, $icDireccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Elemento modificado con exito');

            return $this->redirectToRoute('ic_direccion_index');
        }

        return $this->render('admin/ic_direccion/edit.html.twig', [
            'ic_direccion' => $icDireccion,
            'form' => $form->createView(),
        ]);
    }

    public function delete(Request $request, IcDireccion $icDireccion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icDireccion->getIdDireccion(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icDireccion);
            $this->addFlash('success', 'Elemento dado de baja con exito');
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin/ic_direccion_index');
    }
}
