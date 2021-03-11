<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 16/12/20
 * Time: 12:57
 */

namespace App\Controller\Patrocinios;


use App\Entity\IcPagoProyectado;
use App\Entity\IcPatrocinador;
use App\Helpers\IcProfileTrait;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\IcJsonService;
use App\Helpers\IcConfig;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IcDefaultController extends AbstractController
{

    use IcProfileTrait;

    public function index(): Response
    {
        $totalPatrocinadores = $this->getDoctrine()
            ->getRepository(IcPatrocinador::class)
            ->countPatrocinadores($this->getUser());

        $montoTotalProyectado = $this->getDoctrine()
            ->getRepository(IcPagoProyectado::class)
            ->montoTotalProyectado($this->getUser());

        $number = random_int(0, 500);
        $number2 = random_int(0, 500000);
        $number3 = random_int(0, 500000);


        return $this->render('patrocinios/index.html.twig', [
            'number' => $number,
            'number2' => $number2,
            'number3' => $number3,
            'totalPatrocinadores' => $totalPatrocinadores,
            'montoTotalProyectado' => $montoTotalProyectado
        ]);
    }
}