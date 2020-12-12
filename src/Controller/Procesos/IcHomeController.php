<?php

namespace App\Controller\Procesos;


use App\Entity\IcFosPerfil;
use App\Entity\IcProcedimientos;
use App\Entity\IcInstruccionTrabajo;
use App\Entity\IcProcesos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Helpers\IcProfileTrait;

class IcHomeController extends AbstractController
{
use IcProfileTrait;

    public function index(): Response
    {
        return $this->render('procesos/default/index.html.twig');
    }

    public function tipo(Request  $request, UserPasswordEncoderInterface $passwordEncoder ): Response
    {
        try{

            $procesos = $this->getDoctrine()
            ->getRepository(IcProcesos::class)
            ->findBy(array('idMacroprocesos'=> $request->get('idMacroproceso')));
           
            if(!$procesos){
                $this->addFlash('success', 'No existe informacion de tipo de procesos.sss');
                return $this->redirect($request->headers->get('referer'));
            }

        }catch(\Exception $e ){
            $this->addFlash('danger', 'Error al mostrar informacion de procesos');
        }
        return $this->render('procesos/default/tipo_control.html.twig', array(
            'procesos' => $procesos
        ));
    }

    public function menuProcedimiento(Request $request)
    {
        $procedimientos = $this->getDoctrine()
            ->getRepository(IcProcedimientos::class)
            ->findBy(array('idProcesos'=> $request->get('idProcedimiento')));

        if (!$procedimientos){
            $this->addFlash('success', 'No existe informacion del procedimiento');
            return $this->redirect($request->headers->get('referer'));
        }
       
        return $this->render('procesos/default/menuprocedimiento.html.twig', array(
            'procedimientos' => $procedimientos
        ));
    }

    public function egresos(Request $request, IcProcedimientos $procedimiento)
    {

        if(!$procedimiento)
            throw $this->createNotFoundException('No existe informacion del procedimiento ');

        $instructivo = $this->getDoctrine()
            ->getRepository(IcInstruccionTrabajo::class)
            ->findOneBy(array('idProcedimiento' => $request->get('id')));

        if(!$instructivo){
            $this->addFlash('success', 'No existe la Instruccion de Trabajo');
            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('procesos/default/egresos.html.twig',
            array('instructivo' => $instructivo ));
    }
}
