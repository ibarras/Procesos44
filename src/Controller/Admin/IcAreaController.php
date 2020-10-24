<?php

namespace App\Controller\Admin;

use App\Entity\IcArea;
use App\Form\IcAreaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IcAreaController extends AbstractController
{

    public function index(): Response
    {
        $icAreas = $this->getDoctrine()
            ->getRepository(IcArea::class)
            ->findAll();

        return $this->render('admin/ic_area/index.html.twig', [
            'ic_areas' => $icAreas,
        ]);
    }


    public function new(Request $request): Response
    {
        $icArea = new IcArea();
        $form = $this->createForm(IcAreaType::class, $icArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($icArea);
            $entityManager->flush();
            $this->addFlash('success', 'Elemento agregado con exito');

            return $this->redirectToRoute('procesos_area');
        }

        return $this->render('admin/ic_area/new.html.twig', [
            'ic_area' => $icArea,
            'form' => $form->createView(),
        ]);
    }


    public function show(IcArea $icArea): Response
    {
        return $this->render('admin/ic_area/show.html.twig', [
            'ic_area' => $icArea,
        ]);
    }


    public function edit(Request $request, IcArea $icArea): Response
    {
        $form = $this->createForm(IcAreaType::class, $icArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Elemento modificada con exito');

            return $this->redirectToRoute('procesos_area');
        }

        return $this->render('admin/ic_area/edit.html.twig', [
            'ic_area' => $icArea,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, IcArea $icArea): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icArea->getIdArea(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icArea);
            $entityManager->flush();
            $this->addFlash('success', 'Elemento eliminaad con exito');
        }

        return $this->redirectToRoute('procesos_area');
    }
}
