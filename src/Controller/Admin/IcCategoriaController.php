<?php

namespace App\Controller\Admin;

use App\Entity\IcCategoria;
use App\Form\IcCategoriaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class IcCategoriaController extends AbstractController
{

    public function index(): Response
    {
        $icCategorias = $this->getDoctrine()
            ->getRepository(IcCategoria::class)
            ->findBy(array(), array('idCategoria' => 'DESC' ));

        return $this->render('ic_categoria/index.html.twig', [
            'ic_categorias' => $icCategorias,
        ]);
    }
    
    public function new(Request $request): Response
    {
        $categoria = new IcCategoria();
        $form = $this->createForm(IcCategoriaType::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoria);
            $entityManager->flush();
            $this->addFlash('success', 'Elemento agregado con exito');
            return $this->redirectToRoute('procesos_categoria');
        }

        return $this->render('ic_categoria/new.html.twig', [
            'ic_categorium' => $categoria,
            'form' => $form->createView(),
        ]);
    }


    public function show(IcCategoria $categoria): Response
    {
        return $this->render('ic_categoria/show.html.twig', [
            'ic_categorium' => $categoria,
        ]);
    }


    public function edit(Request $request, IcCategoria $categoria): Response
    {
        $form = $this->createForm(IcCategoriaType::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Elemento modificado con exito');

            return $this->redirectToRoute('procesos_categoria');
        }

        return $this->render('ic_categoria/edit.html.twig', [
            'ic_categorium' => $categoria,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, IcCategoria $categoria): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoria->getIdCategoria(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoria);
            $entityManager->flush();
            $this->addFlash('success', 'Elemento eliminado con exito');

        }

        return $this->redirectToRoute('procesos_categoria');
    }
}
