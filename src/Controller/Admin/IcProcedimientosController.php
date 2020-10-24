<?php

namespace App\Controller\Admin;

use App\Entity\IcProcedimientos;
use App\Entity\IcMacroprocesos;
use App\Entity\IcProcesos;
use App\Form\IcProcedimientosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\IcInstruccionTrabajo;


class IcProcedimientosController extends AbstractController
{

    public function index(Request $request ): Response
    {
        $procedimiento = $this->getDoctrine()
            ->getRepository(IcProcedimientos::class)
            ->findBy(array('idProcesos' => $request->get('id') ));

        if(!$procedimiento) {
            $this->addFlash('danger', 'El procedimiento que busca no existe');
            return $this->redirectToRoute('procesos_macroprocesos');
        }

        return $this->render('admin/ic_procedimientos/index.html.twig', [
            'ic_procedimientos' => $procedimiento,
            'idProcesos' => $request->get('id'),
        ]);
    }

    public function show(Request $request, IcProcedimientos $procedimiento ): Response
    {
        try {

            if (!$procedimiento) {
                $this->addFlash('danger', 'No existe procedimiento');
                $this->redirect($request->headers->get('referer'));
            }

            $instructivo = $this->getDoctrine()
                ->getRepository(IcInstruccionTrabajo::class)
                ->findOneBy(array('idProcedimiento' => $procedimiento->getId()));
        }catch (\Exception $exception){
            $this->addFlash('danger','Error al mostrar el procedimiento '. $exception->getMessage()  );
        }
        return $this->render('admin/ic_procedimientos/show.html.twig', array(
            'procedimiento' => $procedimiento,
            'instructivo'   => $instructivo
        ));
    }

    public function new(Request $request): Response
    {
        $proceso = $this->getDoctrine()
            ->getRepository(IcProcesos::class)
            ->findOneBy(array('id' => $request->get('idProcesos')));

        if(!$proceso){
            $this->addFlash('danger', 'No existe proceso para agregar el procedimiento');
            $this->redirect($request->headers->get('referer'));
        }

        $icProcedimiento = new IcProcedimientos();
        $icProcedimiento->setIdProcesos($proceso);
        $form = $this->createForm(IcProcedimientosType::class, $icProcedimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($icProcedimiento);
            $entityManager->flush();

            return $this->redirectToRoute('procesos_procesos', array(
                'idMacroproceso' => $icProcedimiento->getIdProcesos()->getIdMacroprocesos()->getId()));
        }

        return $this->render('admin/ic_procedimientos/new.html.twig', [
            'ic_procedimiento' => $icProcedimiento,
            'form' => $form->createView(),
        ]);
    }


    public function edit(Request $request, IcProcedimientos $icProcedimiento): Response
    {
        $form = $this->createForm(IcProcedimientosType::class, $icProcedimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Exito al modificar el elemento');
            return $this->redirectToRoute('procesos_procedimientos_editar', array('id' => $icProcedimiento->getId()));
        }

        return $this->render('admin/ic_procedimientos/edit.html.twig', [
            'ic_procedimiento' => $icProcedimiento,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, IcProcedimientos $icProcedimiento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icProcedimiento->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icProcedimiento);
            $entityManager->flush();
            $this->addFlash('success', 'Exito al dar de baja el elemento');
        }
        return $this->redirectToRoute('procesos_procesos', array(
            'idMacroproceso' => $icProcedimiento->getIdProcesos()->getIdMacroprocesos()->getId()));

    }
}
