<?php

namespace App\Controller\Procesos;

use App\Controller\ApiController;
use App\Entity\FosUser;
use App\Entity\IcActivosFijos;
use App\Entity\IcSolicitudSalidaActivos;
use App\Form\IcActivosFijosType;
use App\Repository\IcActivosFijosRepository;
use App\Repository\IcSolicitudSalidaActivosRepository;
use App\Service\IcJsonService;
use App\Repository\IcAreaRepository;
use PHPUnit\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Filesystem\Filesystem;



/**
 * @Route("/ic/activos/fijos")
 */
class IcActivosFijosController extends AbstractController
{
    /**
     * @Route("/", name="ic_activos_fijos_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        return $this->render('procesos/ic_activos_fijos/index.html.twig');
    }



    public function getActivos(Request $request, IcActivosFijosRepository $repository, ApiController $api)
    {
        $post = $request->getContent();
        $icActivosFijos = null;
        $area = null;
        $stdClass = null;

        if($post){
            $stdClass = json_decode($post);
            $icActivosFijos = $this->getDoctrine()
                ->getRepository(IcActivosFijos::class)
                ->findBy(['idArea' => $stdClass->Area ]);
        }else {
            $icActivosFijos = $this->getDoctrine()
                ->getRepository(IcActivosFijos::class)
                ->findBy(['idUsuarioEquipo' => $this->getUser()]);
        }
        if(!$icActivosFijos)
            return $api->responseWithErrors('No se encontro infromacion');

        $data = $repository->transformAll($icActivosFijos);

        return $api->responseIc($data);

    }


    /**
     * @Route("/json-area")
     */

    public function getArea(ApiController $api, IcJsonService $jsonService, IcAreaRepository $areaRepository){

        $data = $jsonService->getArea($areaRepository);
        return $api->responseIc($data);
    }

    public function getSalida(Request $request, MailerInterface $mailer, ApiController $api)
    {
        try {
            $post = $request->get('activo');
            $entityManager = $this->getDoctrine()->getManager();

            $activo = $this->getDoctrine()->getRepository(IcActivosFijos::class)->find($post);
            $activo->setEstatus(true);


            $solicitud = new IcSolicitudSalidaActivos();
            $solicitud->setEstatus(false);
            $solicitud->setIdActivoFijo($activo);
            $solicitud->setCodigoAutorizacion(sha1($activo->getCodigoBarras()));
            $solicitud->setIdUsuario($this->getUser());
            $solicitud->setFechaSolicitud(new \DateTime());

            $entityManager->persist($solicitud);
            $entityManager->flush();

            $entityManager->persist($activo);
            $entityManager->flush();

            $email = (new TemplatedEmail())
                ->from('info@xolos.com.mx')
                ->to('mic@xolos.com.mx')
                //->cc('cc@example.com')
                ->subject('Salida de activos fijos!')
                ->htmlTemplate('procesos/templates/autorizacion_activo_fijo.html.twig')
                // pass variables (name => value) to the template
                ->context([
                    'codigo_interno'        => $activo->getCodigoBarras(),
                    'serie'                 => $activo->getSerie(),
                    'modelo'                => $activo->getModelo(),
                    'marca'                 => $activo->getMarca(),
                    'descripcion'           => $activo->getDescripcion(),
                    'username'              => $this->getUser()->getUsername(),
                    'codigo_autorizacion'   => $solicitud->getCodigoAutorizacion(),
                    'correo'                => $activo->getIdUsuarioArea()->getEmail(),
                ]);

            $mailer->send($email);
            return $api->responseIc(['success' => ' Solicitud enviada con exito']);

        }catch (\Exception $exception){
            return $api->responseWithErrors('Ocurrio un error en autorizacion ' . $exception->getMessage());
        }
    }

    public function getAutorizacion(Request $request, IcActivosFijosRepository $fijosRepository,
                                    IcSolicitudSalidaActivosRepository $solicitudActivos, ApiController $api,
                                    MailerInterface $mailer)
    {
       try{
           $codigo = $request->get('codigo');
           $correo = $request->get('correo');

           $em         = $this->getDoctrine()->getManager();
           $solicitud  = $solicitudActivos->findOneBy(['codigo_autorizacion' => $codigo]);
           $activo     = $fijosRepository->findOneBy(['id' => $solicitud->getIdActivoFijo() ]);
           $perfil     = $this->getDoctrine()->getRepository(FosUser::class)->findOneBy(['email' => $correo]);

           if(!$perfil->getEmail() == $activo->getIdUsuarioArea()->getEmail())
               return $api->responseWithErrors('Usuario no valido para autorizar ');


           $solicitud->setFechaAutorizacion(new \DateTime());
           $solicitud->setIdUsuarioaAutoriza($perfil);
           $solicitud->setEstatus(true);
           $em->persist($solicitud);
           $em->flush();

           $email = (new TemplatedEmail())
               ->from('info@xolos.com.mx')
               ->to('mic@xolos.com.mx')
               //->cc('cc@example.com')
               ->subject('Salida de activos fijos!')
               ->htmlTemplate('procesos/templates/autorizacion_activo_fijo.html.twig')
               // pass variables (name => value) to the template
               ->context([
                   'codigo_interno'        => $activo->getCodigoBarras(),
                   'serie'                 => $activo->getSerie(),
                   'modelo'                => $activo->getModelo(),
                   'marca'                 => $activo->getMarca(),
                   'descripcion'           => $activo->getDescripcion(),
                   'username'              => $this->getUser()->getUsername(),
                   'codigo_autorizacion'   => $solicitud->getCodigoAutorizacion(),
                   'correo'                => $activo->getIdUsuarioArea()->getEmail(),
               ]);

           $mailer->send($email);

           return $api->responseIc(['success' => 'Autorizacion exitosa']);

       }catch (\Exception $exception) {
           return $api->responseWithErrors('Ocurrio un error al autorizar la salida. ');
       }
    }


    public function getSolicitudes(IcSolicitudSalidaActivosRepository $repository)
    {
        $solicitudes = $repository->getSolicitudes();

        if(!$solicitudes)
            $this->addFlash('danger', 'No existen solicitudes de salida');

        return $this->render('procesos/ic_activos_fijos/solicitudes.html.twig', ['solicitudes' => $solicitudes] );

    }


    public function getSalidaFecha(Request $request, IcSolicitudSalidaActivosRepository $fijosRepository, ApiController $api)
    {
        try{
            $post = $request->get('Activo');

            if(!$post)
                return $this->addFlash('danger', 'Debe seleccionar un elemento');

            $em = $this->getDoctrine()->getManager();
            $activo = $fijosRepository->findOneBy(['id_activo_fijo' => $post ]);

            $activo->setFechaSalida( new \DateTime());
            $activo->setEstatus(true);
            $em->persist($activo);
            $em->flush();
            $this->addFlash('success', 'Exito en el activo de salida ');
            return $this->redirectToRoute('activos_solicitues');

        }catch (\Exception $exception){
            $this->addFlash('danger', 'Error al aplicar la salida ' . $exception->getMessage());

        }

    }

    /**
     * @Route("/new", name="ic_activos_fijos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $icActivosFijo = new IcActivosFijos();
        $form = $this->createForm(IcActivosFijosType::class, $icActivosFijo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($icActivosFijo);
            $entityManager->flush();

            return $this->redirectToRoute('ic_activos_fijos_index');
        }

        return $this->render('procesos/ic_activos_fijos/new.html.twig', [
            'ic_activos_fijo' => $icActivosFijo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ic_activos_fijos_show", methods={"GET"})
     */
    public function show(IcActivosFijos $icActivosFijo): Response
    {
        return $this->render('procesos/ic_activos_fijos/show.html.twig', [
            'ic_activos_fijo' => $icActivosFijo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ic_activos_fijos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IcActivosFijos $icActivosFijo): Response
    {
        $form = $this->createForm(IcActivosFijosType::class, $icActivosFijo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ic_activos_fijos_index');
        }

        return $this->render('procesos/ic_activos_fijos/edit.html.twig', [
            'ic_activos_fijo' => $icActivosFijo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ic_activos_fijos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IcActivosFijos $icActivosFijo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icActivosFijo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icActivosFijo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ic_activos_fijos_index');
    }
}
