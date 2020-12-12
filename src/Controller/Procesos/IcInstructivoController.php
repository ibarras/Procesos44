<?php
namespace App\Controller\Procesos;

use App\Entity\IcInstructivo;
use App\Entity\IcProcedimientos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\ApiController;

class IcInstructivoController extends   AbstractController
{
    public function show(Request $request, IcInstructivo $icInstructivo ): Response
    {

        $api = new ApiController();
        if (!$icInstructivo){
            $this->addFlash('danger', 'El instructivo que busca no existe');
            return $this->redirect($request->headers->get('referer'));
        }
            
        return $this->render('procesos/ic_procedimientos/instructivo.html.twig', array(
                'instructivo' => $icInstructivo
                ));
    }
}
