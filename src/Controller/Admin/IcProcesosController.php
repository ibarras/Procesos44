<?php

namespace App\Controller\Admin;

use App\Entity\IcProcedimientos;
use App\Entity\IcMacroprocesos;
use App\Entity\IcProcesos;
use App\Form\IcProcesosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IcProcesosController extends AbstractController
{

    public function macroprocesos(): Response
    {
        $macro = $this->getDoctrine()
            ->getRepository(IcMacroprocesos::class)
            ->findAll();
        return $this->render('admin/ic_procesos/macroprocesos.html.twig', array(
            'procedimientos' => $macro,
        ));
    }

    public function procesos(Request $request)
    {
        $procesos = $this->getDoctrine()
            ->getRepository(IcProcesos::class)
            ->findBy(array('idMacroprocesos' => $request->get('idMacroproceso') ));

        $macro = $this->getDoctrine()
            ->getRepository(IcMacroprocesos::class)
            ->findOneBy(array('id' => $request->get('idMacroproceso')));

        if(!$procesos) {
            return $this->redirectToRoute('procesos_procesos_agregar', array('idMacroproceso' => $request->get('idMacroproceso')));
        }
        return $this->render('admin/ic_procesos/procesos.html.twig', array(
            'procesos' => $procesos,
            'idMacroproceso' => $macro
        ));

    }

    public function new(Request $request): Response
    {
        $icProcesos = new IcProcesos();
        $form = $this->createForm(IcProcesosType::class, $icProcesos);

        try{
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($icProcesos);
                $entityManager->flush();
                $this->addFlash('success', 'Elemento agregado con exito');
                return $this->redirectToRoute('procesos_procesos', array('idMacroproceso' => $request->get('idMacroproceso')) );
            }
        }catch (\Exception $exception){
            $this->addFlash('danger', 'Error al agregar el elemento '. $exception->getMessage());
        }

        return $this->render('admin/ic_procesos/new.html.twig', array(
            'idMacroproceso' => $request->get('idMacroproceso'),
            'form' => $form->createView(),
        ));
    }

    public function edit(Request $request, IcProcesos $icProcesos): Response
    {

        $form = $this->createForm(IcProcesosType::class, $icProcesos);
        $form->handleRequest($request);

        try{
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('success', 'Elemento editado con exito');
                return $this->redirectToRoute('procesos_procesos');
            }
        }catch (\Exception $exception){
            $this->addFlash('danger', 'Error al editar el elemento');
        }
        return $this->render('admin/ic_procesos/edit.html.twig', [
            'ic_procesos' => $icProcesos,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, IcProcesos $icProcesos): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icProcesos->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icProcesos);
            $this->addFlash('danger', 'Elemento dado de baja con exito.');
            $entityManager->flush();
        }

        return $this->redirectToRoute('procesos_procesos', array(
            'idMacroproceso' => $icProcesos->getIdMacroprocesos()->getId()));    }

}
