<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 18/12/20
 * Time: 13:02
 */

namespace App\Controller\Patrocinios;


use App\Controller\ApiController;
use App\Entity\IcPatrocinador;
use App\Entity\IcPago;
use App\Entity\IcPagoProyectado;
use App\Form\IcPagoProyectadoType;
use App\Helpers\IcProfileTrait;
use App\Repository\IcPagoProyectadoRepository;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\IcJsonService;
use App\Helpers\IcConfig;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IcPagoProyectadoController extends AbstractController
{

    use IcProfileTrait;

    public function listarPagosProyectados(Request $request)
    {
        $em = $this->getDoctrine()->getRepository(IcPagoProyectado::class);
        $pagosProyectados = $em->pagosProyectadosUsuario($this->getUser());

        return $this->render('patrocinios/pagos_proyectados/index.html.twig', [
            'pagosProyectados' => $pagosProyectados
        ]);
    }

    public function agregarPagoProyectado(Request $request)
    {
        $pagoPatrocinador = new IcPagoProyectado();
        $form = $this->createForm(IcPagoProyectadoType::class, $pagoPatrocinador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pagoPatrocinador);
            $entityManager->flush();

            return $this->redirectToRoute('lista_pagos_proyectados');
        }

        return $this->render('patrocinios/pagos_proyectados/agregar.html.twig', array('form' => $form->createView()));
    }

    public function editarPagoProyectado(Request $request, IcPagoProyectado $pagoProyectado)
    {
        $editForm = $this->createForm(IcPagoProyectadoType::class, $pagoProyectado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pagoProyectado);
            $em->flush();

            return $this->redirectToRoute('lista_pagos_proyectados');
        }

        return $this->render('patrocinios/pagos_proyectados/editar.html.twig', array(
            'pagoProyectado' => $pagoProyectado,
            'form' => $editForm->createView()
        ));
    }

    public function getPagosProyectados(Request $request, IcPagoProyectadoRepository $repository, ApiController $api)
    {
        $post = $request->getContent();
        $icPagosProyectados = null;
        $mes = null;
        $anio = null;
        $stdClass = null;

        if($post){
            $stdClass = json_decode($post);
            $icPagosProyectados = $this->getDoctrine()
                ->getRepository(IcPagoProyectado::class)
                ->getPagosproyectadosMes($stdClass->iDate, $stdClass->fDate);

        }else {
            $icPagosProyectados = $this->getDoctrine()
                ->getRepository(IcPagoProyectado::class)
                ->getPagosProyectadosAnio();
        }
        if(!$icPagosProyectados)
            return $api->responseNotFound();

        //$depositosArray = [];
        $totalIngresado = 0;

        $em = $this->getDoctrine()->getRepository(IcPago::class);

        foreach ($icPagosProyectados as $proyectado)
        {
            $depositos = $em->findBy(array('idPagoProyectado' => $proyectado->getId()));

            foreach ($depositos as $deposito)
            {
                $totalIngresado = $totalIngresado + $deposito->getMonto();

            }
        }
        //$depositosArray[]= $total;



        $data = $repository->transformAll($icPagosProyectados);

        //$year_start = date('Y-m-d', strtotime('first day of January this year', time()));
        //$year_end = date('Y-m-d', strtotime('last day of December this year', time()));

        $datos = [
            'proyectados' => $data,
            'total_ingresado' => $totalIngresado
        ];

        return $api->responseIc($datos);
    }
}