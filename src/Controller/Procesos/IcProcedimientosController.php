<?php
namespace App\Controller\Procesos;

use App\Entity\IcInstruccionTrabajo;
use App\Entity\IcInstructivo;
use App\Entity\IcProcedimientos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;


class IcProcedimientosController extends AbstractController
{

    public function procedimiento(Request $request, IcProcedimientos $procedimientos)
    {
        if (!$procedimientos){
            $this->addFlash('danger', 'No existe el procedimiento que busca');
            return $this->redirect($request->headers->get('referer'));
        }
            

        $instruccion = $this->getDoctrine()
                            ->getRepository(IcInstruccionTrabajo::class)
                            ->findOneBy(array('idProcedimiento' => $procedimientos->getId()));

        return $this->render('procesos/ic_procedimientos/procedimiento.html.twig', array(
                'procedimiento' => $procedimientos,
                'instruccion' => $instruccion
                ));

    }

    public function instruccion(Request $request, IcInstruccionTrabajo $instruccion )
    {
        if (!$instruccion){
            $this->addFlash('danger', 'No existe la instruccion de trabajo que busca');
            return $this->redirect($request->headers->get('referer'));
        }

        $instructivo = $this->getDoctrine()
                            ->getRepository(IcInstructivo::class)
                            ->findOneBy(array('idInstruccion' => $instruccion->getId()));

        return $this->render('procesos/ic_procedimientos/instruccion_trabajo.html.twig', array(
            'instruccion' => $instruccion,
            'instructivo' => $instructivo
        ));

    }





}
