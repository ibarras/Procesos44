<?php

namespace App\Controller\Admin;

use App\Entity\IcInstruccionTrabajo;
use App\Entity\IcProcedimientos;
use App\Form\IcInstruccionTrabajoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\IcInstructivo;

class IcInstruccionTrabajoController extends AbstractController
{

    public function index(): Response
    {
        $icInstruccionTrabajos = $this->getDoctrine()
            ->getRepository(IcInstruccionTrabajo::class)
            ->findAll();

        return $this->render('admin/ic_instruccion_trabajo/index.html.twig', [
            'ic_instruccion_trabajos' => $icInstruccionTrabajos,
        ]);
    }


    public function new(Request $request): Response
    {
        $procedimiento = $this->getDoctrine()
            ->getRepository(IcProcedimientos::class)
            ->find($request->get('idProcedimiento'));

        if(!$procedimiento){
            $this->addFlash('danger', 'No existe procedimiento para la instruccion de trabajo');
            return $this->redirect($request->headers->get('referer'), 302);
        }

        $icInstruccionTrabajo = new IcInstruccionTrabajo();
        $icInstruccionTrabajo->setIdProcedimiento($procedimiento);
        $form = $this->createForm(IcInstruccionTrabajoType::class, $icInstruccionTrabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //$icInstruccionTrabajo->setIcImagen($icInstruccionTrabajo->getFile());

            $entityManager->persist($icInstruccionTrabajo);
            $entityManager->flush();
            $this->addFlash('success', 'Instruccion de Trabajo agregado con exito');
            return $this->redirect($request->headers->get('referer'), 302);
        }

        return $this->render('admin/ic_instruccion_trabajo/new.html.twig', [
            'ic_instruccion_trabajo' => $icInstruccionTrabajo,
            'form' => $form->createView(),
        ]);
    }


    public function show(IcInstruccionTrabajo $ic, Request $request): Response
    {
        if(!$ic){
            $this->addFlash('danger', 'La instruccion de trabajo que busca no existe');
            $this->redirect($request->headers->get('referer'));
        }
        $descripcion = $this->getDoctrine()
            ->getRepository(IcInstructivo::class)
            ->findOneBy(array('idInstruccion' => $ic->getId() ));

        return $this->render('admin/ic_instruccion_trabajo/show.html.twig', [
            'instruccion_trabajo' => $ic,
            'idescripcion' => $descripcion,
        ]);
    }


    public function edit(Request $request, IcInstruccionTrabajo $icInstruccionTrabajo): Response
    {
        $form = $this->createForm(IcInstruccionTrabajoType::class, $icInstruccionTrabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin/ic_instruccion_trabajo_index');
        }

        return $this->render('admin/ic_instruccion_trabajo/edit.html.twig', [
            'ic_instruccion_trabajo' => $icInstruccionTrabajo,
            'form' => $form->createView(),
        ]);
    }

    public function delete(Request $request, IcInstruccionTrabajo $icInstruccionTrabajo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icInstruccionTrabajo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icInstruccionTrabajo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ic_instruccion_trabajo_index');
    }
}
