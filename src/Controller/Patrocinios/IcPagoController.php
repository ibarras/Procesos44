<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 29/12/20
 * Time: 11:12
 */

namespace App\Controller\Patrocinios;


use App\Controller\ApiController;
use App\Entity\IcPago;
use App\Entity\IcPatrocinador;
use App\Entity\IcPagoProyectado;
use App\Form\IcPagoType;
use App\Helpers\IcProfileTrait;
use App\Repository\IcPagoRepository;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\IcJsonService;
use App\Helpers\IcConfig;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IcPagoController extends AbstractController
{
    public function listarDepositos(Request $request)
    {
        return $this->render('patrocinios/depositos/index.html.twig');
    }

    public function agregarDeposito(Request $request, IcPagoProyectado $pagoProyectado)
    {
        $deposito = new IcPago();
        $deposito->setIdPagoProyectado($pagoProyectado);
        $deposito->setFecha(new \DateTime());
        $form = $this->createForm(IcPagoType::class, $deposito);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deposito);
            $entityManager->flush();

            return $this->redirectToRoute('lista_depositos');
        }

        return $this->render('patrocinios/depositos/agregar.html.twig', array('form' => $form->createView()));
    }

    public function depositosPagoProyectado(Request $request, IcPagoProyectado $pagoProyectado)
    {
        $em = $this->getDoctrine()->getRepository(IcPago::class);
        $depositos = $em->findBy(array('idPagoProyectado' => $pagoProyectado->getId()));

        //dump($depositos);

        return $this->render('patrocinios/depositos/pago_proyectado_depositos.html.twig', [
            'depositos' => $depositos,
            'pagoProyectado' => $pagoProyectado
        ]);
    }

    public function depositosPorPago(Request $request, IcPagoRepository $repository, ApiController $api)
    {
        $post = $request->getContent();
        $depositos = null;
        $stdClass = null;

        if($post)
        {
            $stdClass = json_decode($post);
            $depositos = $this->getDoctrine()
                ->getRepository(IcPago::class)
                ->findBy(array('idPagoProyectado' => $stdClass->Pago));
        }
        else
        {

        }

        if (!$depositos)
        {
            return $api->responseNotFound();
        }

        $data = $repository->transformAll($depositos);

        return $api->responseIc($data);
    }
}