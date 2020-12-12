<?php
namespace App\Controller\Procesos;

use App\Entity\IcInstruccionTrabajo;
use App\Entity\IcInstructivo;
use App\Entity\IcProcedimientos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;
use Symfony\Component\HttpFoundation\Response;

class IcInstruccionTrabajoController extends AbstractController
{


    public function show(Request $request,  IcInstruccionTrabajo $instruccion ): Response
    {
        if (!$instruccion){
            $this->addFlash('danger', 'No la instruccion de trabajo que busca');
            return $this->redirect($request->headers->get('referer'));
        }
            
        return $this->render('procesos/ic_procedimientos/instruccion_trabajo.html.twig', array(
                'instruccion' => $instruccion
                ));
    }

}
