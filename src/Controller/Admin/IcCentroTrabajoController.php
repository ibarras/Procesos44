<?php

namespace App\Controller\Admin;

use App\Entity\IcCentroTrabajo;
use App\Form\IcCentroTrabajoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IcCentroTrabajoController extends AbstractController
{

    public function index(): Response
    {
        $icCentroTrabajos = $this->getDoctrine()
            ->getRepository(IcCentroTrabajo::class)
            ->findAll();

        return $this->render('admin/ic_centro_trabajo/index.html.twig', [
            'ic_centro_trabajos' => $icCentroTrabajos,
        ]);
    }


    public function new(Request $request): Response
    {
        $icCentroTrabajo = new IcCentroTrabajo();
        $form = $this->createForm(IcCentroTrabajoType::class, $icCentroTrabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($icCentroTrabajo);
            $entityManager->flush();
            $this->addFlash('success', 'Elemento agregado con exito');
            return $this->redirectToRoute('ic_centro_trabajo_index');
        }

        return $this->render('admin/ic_centro_trabajo/new.html.twig', [
            'ic_centro_trabajo' => $icCentroTrabajo,
            'form' => $form->createView(),
        ]);
    }


    public function edit(Request $request, IcCentroTrabajo $icCentroTrabajo): Response
    {
        $form = $this->createForm(IcCentroTrabajoType::class, $icCentroTrabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Elemento modificado con exito');
            return $this->redirectToRoute('admin/ic_centro_trabajo_index');
        }

        return $this->render('admin/ic_centro_trabajo/edit.html.twig', [
            'ic_centro_trabajo' => $icCentroTrabajo,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, IcCentroTrabajo $icCentroTrabajo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icCentroTrabajo->getIdCentro(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icCentroTrabajo);
            $this->addFlash('success', 'Elemento dado de baja con exito');
            $entityManager->flush();
        }

        return $this->redirectToRoute('ic_centro_trabajo_index');
    }
}
