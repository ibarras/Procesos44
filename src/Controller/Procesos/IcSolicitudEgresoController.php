<?php

namespace App\Controller\Procesos;

use App\Entity\IcSolicitud;
use App\Entity\IcSolicitudDescripcion;
use App\Helpers\IcProfileTrait;
use App\Repository\IcSolicitudRepository;
use App\Service\IcSolicitudService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\IcJsonService;
use App\Helpers\IcConfig;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Controller\ApiController;
use App\Entity\IcSolicitudDescripcionDeposito;

class IcSolicitudEgresoController extends AbstractController
{

    use IcProfileTrait;

    /*
    * @Method("GET")
    */
    public function index(Request $request)
    {
        return $this->render('procesos/ic_solicitud_egreso/index.html.twig' );
    }

    public function getSolicitudesPorUsuario(Request $request, IcSolicitudService $service, ApiController $apiController)
    {
        try {
            $solicitudes = $service->getSolicitudes($this->getUser()->getId(), IcConfig::IC_SOLICITUD_EGRESO, true);

            if(!$solicitudes)
                return $apiController->responseIc(['error' =>'Error al procesar las solicitudes del usuario '],
                            $apiController->responseWithErrors('No existen solicitudes para este usuario'));

        } catch ( \Exception $e) {
           return $apiController->responseIc(['error' =>'Error al procesar las solicitudes del usuario '],
                $apiController->responseWithErrors('No existen solicitudes para este usuario'));
        }
        return $solicitudes;
    }

    public function getSolicitudes(IcSolicitudService $service, ApiController $apiController)
    {
        try {

            $solicitudes = $service->getSolicitudesPorTipo(IcConfig::IC_SOLICITUD_EGRESO, true);

            if(!$solicitudes)
                return $apiController->responseIc(['error' =>'Error al procesar las solicitudes del usuario '],
                $apiController->responseNotFound());

        } catch ( \Exception $e) {
            return $apiController->responseIc(['error' =>'Error al procesar las solicitudes del usuario '],
                $apiController->responseNotFound());
        }
        return $solicitudes;
    }

    /*
    * @Method("POST")
    */
    public function newAction(Request $request)
    {
        return $this->render('@App/icsolicitudegresos/agregar.html.twig', array(
            'seccion' => 'SOLICITUD DE EGRESO',
            'tipoSolicitud' => 1,
        ));
    }

    /*
     *
    * @Method("GET")
    */
    public function show(Request $request, IcSolicitud $solicitud)
    {

        try {
            if (!$solicitud) {
                $this->addFlash('danger', 'No existe la solicitud intente con otra');
                return $this->redirect($request->headers->get('referer'));
            }
            return $this->render('procesos/ic_solicitud_egreso/show.html.twig', array(
                'solicitud' => $solicitud
            ));

        } catch (NotFoundHttpException $exception) {
            $this->addFlash('error', 'Error al obtener la informacion');
        }
    }

    public function template(Request $request)
    {
        try {
            $solicitud = $this->getDoctrine()
                ->getRepository(IcSolicitud::class)
                ->findOneBy(array('id' => $request->get('id')));

            return $this->render('procesos/ic_solicitud_egreso/template.html.twig', array(
                'solicitud' => $solicitud
            ));

        } catch (NotFoundHttpException $exception) {
            $this->addFlash('danger', 'Error al obtener la informacion');
        }
        return $this->render('procesos/ic_solicitud_egreso/template.html.twig', array(
            'solicitud' => $solicitud
        ));
    }

    /**
     * @param Request $request
     * @param IcSolicitudRepository $solicitudRepository
     * @param IcSolicitudService $solicitudService
     * @param ApiController $api
     * @return \App\Controller\Symfony\Component\HttpFoundation\JsonResponse|JsonResponse
     */
    public function getSolicitud(Request $request, IcSolicitudRepository $solicitudRepository,
                                 IcSolicitudService $solicitudService, ApiController $api)
    {

        try {
            $solicitud = $solicitudRepository->find($request->get('id'));

            if (!$solicitud)
                return $api->responseNotFound('Debe proporcionar un ID de solicitud valida');

            $data = $solicitudService->getSolicitud($solicitud);

            return $api->responseIc($data);

        } catch (\Exception $e) {
            $this->addFlash('warning', 'Ocurrio un error al obtener la solicitud ' . $e->getMessage());
            return $api->responseWithErrors('Ocurrio un error al obtener la solicitud' . $e->getMessage());

        }
    }


    /**
     * @param Request $request
     * @param IcSolicitudService $solicitudService
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function onClickAEgresoAgregar(Request $request, IcSolicitudService $solicitudService, ValidatorInterface $validator,
                    LoggerInterface $logger)
    {
        try {
            $post = $request->getContent();

            if (empty($post))
                return $this->render('procesos/ic_solicitud_egreso/agregar.html.twig');

            $array = json_decode($post, 'json');

            $result = $solicitudService->addSolicitud($array, $validator, $this->getUser());
            return $this->redirectToRoute('solicitud_egreso_usuario_show', array('id'=> $result->getId() ));  // new Response($resultadoTotal);

//            if($result instanceof IcSolicitud){
//                $this->addFlash('success', 'Solicitud agregada con exito.');
//                //$resultadoTotal = $solicitudService->getSolicitud($result);
//                return $this->redirectToRoute('solicitud_egreso_usuario_show', array('id'=> $result->getId() ));  // new Response($resultadoTotal);
//            }else{
//                return $this->render('procesos/ic_solicitud_egreso/agregar.html.twig');
//                $this->addFlash('danger', 'Ocurrio un error al agregar la solicitud');
//            }

        } catch (\Exception $e) {
            $logger->error('IC_ERROR -> '. $e->getMessage());
            $this->addFlash('danger', 'Ocurrio un error al dar de alta la IcSolicitud');
        }
        return $this->render('procesos/ic_solicitud_egreso/agregar.html.twig');
    }


    public function onClickAgregarDeposito(Request $request, ApiController $api ) //work
    {
        $post = $request->getContent();
        $stdClass = json_decode($post);

        try {

            if (empty($post))
                return $this->render('@Procesos/icsolicitudegresos/agregar.html.twig');

            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction(); // suspend auto-commit
            /**
             * Se actualiza primero la tabla deposito y despues la tabla descripcion
             *
             */

            $egreso = $this->entityManager->getRepository(IcSolicitudDescripcion::class)
                        ->findOneBy(array('id' => $stdClass->Deposito));
            if(!$egreso)
                return $api->responseNotFound( 'No existe una solicitud para deposito');

            //Objeto para agregar deposito
            $deposito = new IcSolicitudDescripcionDeposito();

            $deposito->setBeneficiario($stdClass->Proveedor);
            $deposito->setTipoGasto($stdClass->TipoGasto);
            $deposito->setCuenta($stdClass->CuentaClabe);
            $deposito->setBanco($stdClass->Banco);
            $deposito->setIdSolicitudDescripcion($egreso);
            /**
             * La cantidad debe ser igual al precio real, de la tabla descripcion.
             */
            $deposito->setCantidad($egreso->getPrecioReal());
            $deposito->setFecha(new \DateTime('now'));
            $deposito->setEsActivo(true);

            $egreso->setEsActivo(false);
            $em->persist($egreso);

            $em->persist($deposito);
            $em->flush();
            $bool = $em->getConnection()->commit();

            if($bool)
                return $api->responseIc(['success' => 'Deposito agregado con exito']);

            return $api->responseWithErrors('Error al agregar el deposito');

        } catch ( Exception $e) {
                return $api->responseWithErrors('Error al agregar el deposito ' . $e->getMessage());
        }
        return $this->render('@App/icsolicitudegresos/show.html.twig');
    }


    /**
     * @param Request $request
     * @param IcSolicitudService $solicitudService
     * @param ApiController $api
     * @return \App\Controller\Symfony\Component\HttpFoundation\JsonResponse|JsonResponse
     */
    public function onClickAgregarDescripcion(Request $request, IcSolicitudService $solicitudService, ApiController $api) //work here add escription
    {
        $post = $request->getContent();
        $stdClass = json_decode($post);

        try {
            $solicitud = $this->entityManager->getRepository(IcSolicitud::class)->find($stdClass->Id);

            if($solicitud)
                $result = $solicitudService->addDescripcionSolicitud($stdClass, $solicitud);

            if(!$result)
                $api->responseNotFound('No existe descripcion de la oslicitud');

            $data = $solicitudService->getSolicitud($solicitud);

            if($data)
                return $api->responseIc($data);

            return $api->responseWithErrors('Error al obtener la informacion de la solicitud');

        } catch (\Exception $exception) {
            $this->addFlash('warning', 'Ocurrio un error: ' . $exception->getMessage());
            return $api->responseWithErrors('Error al obtener la informacion de la solicitud ' . $exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param IcSolicitudService $serivice
     * @param ApiController $api
     * @return \App\Controller\Symfony\Component\HttpFoundation\JsonResponse|JsonResponse
     */
    public function onClickDeleteDescripcion(Request $request, IcSolicitudService $serivice , ApiController $api)
    {
        try {
            $descripcion = $this->entityManager->getRepository(IcSolicitudDescripcion::class)
                            ->find($request->get('id'));
            if(!$descripcion)
                return $api->responseWithErrors('No existe la informacion solicitada');

            $bool  = $serivice->getDeleteDescripcion($descripcion);

            if (!$bool)
                return $api->responseWithErrors('Ocurrio un error al eliminar la Informacion  ');

            $this->addFlash('success', 'Exito al eliminar la descripcion');
            return $api->responseIc(array('success' => 'Se elimino correctamente la Descripcion'));

        } catch (\Exception $e) {
            return $api->responseWithErrors('Ocurrio un error al eliminar la Informacion  ');

        }
    }

    /**
     * @param Request $request
     * @param ApiController $api
     * @param IcSolicitudService $service
     * @return \App\Controller\Symfony\Component\HttpFoundation\JsonResponse|JsonResponse
     */
    public function onClickDeleteDeposito(Request $request, ApiController  $api, IcSolicitudService $service)
    {
        try {
            $deposito = $this->entityManager->getRepository(IcSolicitudDescripcionDeposito::class)
                            ->find($request->get('id'));
            $bool = $service->getDeleteDeposito($deposito);

            if(!$bool)
                return $api->responseWithErrors('Error al eliminar el deposito');

            $update = $this->entityManager->getRepository(IcSolicitudDescripcion::class)
                ->find($deposito->getIdSolicitudDescripcion() );

            $update->setEsActivo(true);
            $this->entityManager->persist($update);
            $this->entityManager->flush();

            return $api->responseIc(array('success' => 'Se elimino correctamente la Informacion'));
        } catch (\Exception $e) {
            return $api->responseWithErrors('Error al eliminar el deposito'. $e->getMessage());
        }
    }


    /**
     * @param Request $request
     * @param IcSolicitudService $service
     * @param ApiController $api
     * @return \App\Controller\Symfony\Component\HttpFoundation\JsonResponse|JsonResponse
     */
    public function onClickDeleteSolicitud(Request $request, IcSolicitudService $service, ApiController  $api)
    {
        try {
            $solicitud = $this->entityManager->getRepository(IcSolicitud::class)->find($request->get('id'));

            if($solicitud)
                $bool = $service->getDeleteSolicitud($solicitud);

            if (!$bool)
                return $api->responseWithErrors('Error al eliminar la solicitud');

            return $api->responseIc(array('success' => 'se elimino correctamente la Solicitud'));
        } catch (\Exception $e) {
            return $api->responseWithErrors('Error al eliminar la solicitud');
        }
    }


    public function getApi(Request $request, IcJsonService $service)
    {
        $opcion = $request->query->get('opcion');

        try {

            if ($opcion == 'tipo-solicitud') {
                return $service->getTipoSolicitud();

            } else if ($opcion == 'cuentas-contables') {
                return $service->getCuentasContables();

            } else if ($opcion == 'torneo-categoria-jornada') {
                return $service->getTorneoCategoriaJornada();

            } else if ($opcion == 'centro-costo') {
                return $service->getCentroCosto($request->query->get('centro'));

            } else if ($opcion == 'direccion') {
                return $service->getDireccion($this->profile()->getIdDireccion()->getIdDireccion());

            } else if ($opcion == 'centro-organizativo-direccion') {
                return $service->getCentroOrganizativo($request->query->get('direccion'));
            }

        } catch (\Exception $e) {
            return new JsonResponse(array('error' => 'Ocurrio un error al eliminar el deposito  '),
                200, array('Content-Type' => 'application/json'));
        }
        return new JsonResponse(array('error' => 'Ocurrio un error al eliminar el deposito  '),
            200, array('Content-Type' => 'application/json'));
    }


}