<?php

namespace App\Controller\Admin;

use App\Entity\IcCuentaContable;
use App\Form\IcCuentaContableType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IcCuentaContableController extends AbstractController
{

    public function index(): Response
    {
        $icCuentaContables = $this->getDoctrine()
            ->getRepository(IcCuentaContable::class)
            ->findAll();

        return $this->render('ic_cuenta_contable/index.html.twig', [
            'ic_cuenta_contables' => $icCuentaContables,
        ]);
    }

    public function new(Request $request): Response
    {
        $icCuentaContable = new IcCuentaContable();
        $form = $this->createForm(IcCuentaContableType::class, $icCuentaContable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($icCuentaContable);
            $this->addFlash('success', 'Elemento agregado con exito');
            $entityManager->flush();

            return $this->redirectToRoute('ic_cuenta_contable_index');
        }

        return $this->render('ic_cuenta_contable/new.html.twig', [
            'ic_cuenta_contable' => $icCuentaContable,
            'form' => $form->createView(),
        ]);
    }


    public function edit(Request $request, IcCuentaContable $icCuentaContable): Response
    {
        $form = $this->createForm(IcCuentaContableType::class, $icCuentaContable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Elemento modificado con exito');

            return $this->redirectToRoute('ic_cuenta_contable_index');
        }

        return $this->render('ic_cuenta_contable/edit.html.twig', [
            'ic_cuenta_contable' => $icCuentaContable,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, IcCuentaContable $icCuentaContable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icCuentaContable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icCuentaContable);
            $this->addFlash('success', 'Elemento dado de baja con exito');

            $entityManager->flush();
        }

        return $this->redirectToRoute('ic_cuenta_contable_index');
    }
}
