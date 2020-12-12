<?php

namespace App\Controller\Admin;

use App\Entity\IcPuesto;
use App\Form\IcPuestoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IcPuestoController extends AbstractController
{

    public function index(): Response
    {
        $icPuestos = $this->getDoctrine()
            ->getRepository(IcPuesto::class)
            ->findAll();

        return $this->render('admin/ic_puesto/index.html.twig', [
            'ic_puestos' => $icPuestos,
        ]);
    }


    public function new(Request $request): Response
    {
        $icPuesto = new IcPuesto();
        $form = $this->createForm(IcPuestoType::class, $icPuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($icPuesto);
            $entityManager->flush();

            return $this->redirectToRoute('ic_puesto_index');
        }

        return $this->render('admin/ic_puesto/new.html.twig', [
            'ic_puesto' => $icPuesto,
            'form' => $form->createView(),
        ]);
    }


    public function show(IcPuesto $icPuesto): Response
    {
        return $this->render('admin/ic_puesto/show.html.twig', [
            'ic_puesto' => $icPuesto,
        ]);
    }


    public function edit(Request $request, IcPuesto $icPuesto): Response
    {
        $form = $this->createForm(IcPuestoType::class, $icPuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ic_puesto_index');
        }

        return $this->render('admin/ic_puesto/edit.html.twig', [
            'ic_puesto' => $icPuesto,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, IcPuesto $icPuesto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icPuesto->getIdPuesto(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icPuesto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ic_puesto_index');
    }
}
