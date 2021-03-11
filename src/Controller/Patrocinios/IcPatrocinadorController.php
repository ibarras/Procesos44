<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 16/12/20
 * Time: 16:26
 */

namespace App\Controller\Patrocinios;


use App\Controller\ApiController;
use App\Entity\IcPatrocinador;
use App\Form\IcPatrocinadorType;
use App\Helpers\IcProfileTrait;
use App\Repository\IcPatrocinadorRepository;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\IcJsonService;
use App\Helpers\IcConfig;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IcPatrocinadorController extends AbstractController
{

    use IcProfileTrait;

    public function listarPatrocinadoresPorUsuario(Request $request)
    {
        $em = $this->getDoctrine()->getRepository(IcPatrocinador::class);
        $patrocinadores = $em->getAllPatrocinadores($this->getUser()->getId());

        return $this->render('patrocinios/patrocinador/index.html.twig', [
            'patrocinadores' => $patrocinadores
        ]);
    }

    public function agregarPatrocinador(Request $request): Response
    {
        $patrocinador = new IcPatrocinador();
        $patrocinador->setIdUsuario($this->getUser());
        $form = $this->createForm(IcPatrocinadorType::class, $patrocinador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patrocinador);
            $entityManager->flush();

            return $this->redirectToRoute('lista_patrocinadores');
        }

        return $this->render('patrocinios/patrocinador/agregar.html.twig', array('form' => $form->createView()));
    }

    public function editarPatrocinador(Request $request, IcPatrocinador $patrocinador)
    {
        $editForm = $this->createForm(IcPatrocinadorType::class, $patrocinador);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($patrocinador);
            $em->flush();

            return $this->redirectToRoute('lista_patrocinadores');
        }

        return $this->render('patrocinios/patrocinador/editar.html.twig', array(
            'patrocinador' => $patrocinador,
            'form' => $editForm->createView()
        ));
    }

    public function countPatrocinadores(Request $request, IcPatrocinadorRepository $repository, ApiController $api)
    {
        $icPatrocinadores = null;
        $stdClass = null;

        $icPatrocinadores = $this->getDoctrine()
            ->getRepository(IcPatrocinador::class)
            ->countAllPatrocinadores();

        if(!$icPatrocinadores)
            return $api->responseWithErrors('No se encontro infromacion');

        return $api->responseIc($icPatrocinadores);
    }
}