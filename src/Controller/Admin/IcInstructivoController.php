<?php

namespace App\Controller\Admin;

use App\Entity\IcInstruccionTrabajo;
use App\Entity\IcInstructivo;
use App\Form\IcInstructivoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IcInstructivoController extends AbstractController
{


    public function new(IcInstruccionTrabajo $instruccionTrabajo, Request $request): Response
    {
        if(!$instruccionTrabajo){
            $this->addFlash('danger', 'No existe la instruccion de trabajo');
            return $this->redirect($request->headers->get('referer'));

        }
        $icInstructivo = new IcInstructivo();
        $icInstructivo->setIdInstruccion($instruccionTrabajo);

        $form = $this->createForm(IcInstructivoType::class, $icInstructivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($icInstructivo);
            $entityManager->flush();
            $this->addFlash('success', 'Elemento creado con exito');
            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('admin/ic_instructivo/new.html.twig', [
            'ic_instructivo' => $icInstructivo,
            'form' => $form->createView(),
        ]);
    }


    public function show(IcInstructivo $icInstructivo): Response
    {
        return $this->render('admin/ic_instructivo/show.html.twig', [
            'instructivo' => $icInstructivo,
        ]);
    }


    public function edit(Request $request, IcInstructivo $icInstructivo): Response
    {
        $form = $this->createForm(IcInstructivoType::class, $icInstructivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Elemento modificado con exito');
            return $this->redirectToRoute('procesos_instructivo_editar');
        }

        return $this->render('admin/ic_instructivo/edit.html.twig', [
            'ic_instructivo' => $icInstructivo,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, IcInstructivo $icInstructivo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icInstructivo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icInstructivo);
            $entityManager->flush();
        }

        return $this->redirect($request->headers->get('referer'));
    }
}
