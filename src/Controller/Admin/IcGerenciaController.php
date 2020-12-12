<?php

namespace App\Controller\Admin;

use App\Entity\IcGerencia;
use App\Form\IcGerenciaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ic/gerencia")
 */
class IcGerenciaController extends AbstractController
{
    /**
     * @Route("/", name="ic_gerencia_index", methods={"GET"})
     */
    public function index(): Response
    {
        $icGerencias = $this->getDoctrine()
            ->getRepository(IcGerencia::class)
            ->findAll();

        return $this->render('admin/ic_gerencia/index.html.twig', [
            'ic_gerencias' => $icGerencias,
        ]);
    }

    /**
     * @Route("/new", name="ic_gerencia_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $icGerencium = new IcGerencia();
        $form = $this->createForm(IcGerenciaType::class, $icGerencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($icGerencium);
            $entityManager->flush();
            $this->addFlash('success', 'Elemento agregado con exito');

            return $this->redirectToRoute('procesos_gerencia');
        }

        return $this->render('admin/ic_gerencia/new.html.twig', [
            'ic_gerencium' => $icGerencium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idGerencia}", name="ic_gerencia_show", methods={"GET"})
     */
    public function show(IcGerencia $icGerencium): Response
    {
        return $this->render('admin/ic_gerencia/show.html.twig', [
            'ic_gerencium' => $icGerencium,
        ]);
    }

    /**
     * @Route("/{idGerencia}/edit", name="ic_gerencia_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IcGerencia $icGerencium): Response
    {
        $form = $this->createForm(IcGerenciaType::class, $icGerencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Elemento modificado con exito');

            return $this->redirectToRoute('procesos_gerencia');
        }

        return $this->render('admin/ic_gerencia/edit.html.twig', [
            'ic_gerencium' => $icGerencium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idGerencia}", name="ic_gerencia_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IcGerencia $icGerencium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icGerencium->getIdGerencia(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icGerencium);
            $this->addFlash('success', 'Elemento dado de baja con exito');
            $entityManager->flush();
        }

        return $this->redirectToRoute('procesos_gerencia');
    }
}
