<?php

namespace App\Controller\Admin;

use App\Controller\ApiController;
use App\Entity\IcDocumentosPerfil;
use App\Entity\IcProcesos;
use App\Form\IcDocumentosPerfilType;
use App\Helpers\IcProfileTrait;
use App\Repository\IcDocumentosPerfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IcDocumentosPerfilController extends AbstractController
{
    use IcProfileTrait;

    public function uploadFile(Request $request, ApiController $api): JsonResponse
    {
        try{
            $file = $request->files->get('file');

            $pro = new IcDocumentosPerfil();

            return $api->responseIc(['success' => 'Ok']);

        }catch (\Exception $exception){
            return $api->responseWithErrors('Ocurrio un error al subir el archivo ' . $exception->getMessage());
        }
        return $api->responseIc(['success' => 'Ok']);

    }
    public function getfaltantes(ApiController $api , IcDocumentosPerfilRepository $documentos){

        $data = $documentos->find(1);
        $doc = $documentos->transform($data);

        $d = [];
        $faltantes = [];
        foreach($doc as $key => $value ) {
            if ($value == null) {
                $d[str_replace('_', ' ', $key)] = $key;
            }

        }$faltantes[] = $d;
        return $api->responseIc($faltantes);

    }

    public function index(Request $request, IcDocumentosPerfilRepository $documentos, ApiController $api ): Response
    {

        $data = $documentos->find(1);
        $doc = $documentos->transform($data);

        $archivos = 0;
        $cant = count($doc);

        foreach($doc as $key => $value ){
            if($value == !null){
                $archivos = $archivos + 1;
            }else{
                $faltantes[] = $key;
            }
        }

        $porcentaje = 0;

        if($archivos > 1)
            $porcentaje = ( $archivos / $cant ) * 100;

        

        return $this->render('admin/ic_documentos_perfil/index.html.twig', [
            'documentos'    => $doc,
            'porcentaje'    => $porcentaje,
        ]);
    }

    
    public function new(Request $request): Response
    {
        $icDocumentosPerfil = new IcDocumentosPerfil();
        $form = $this->createForm(IcDocumentosPerfilType::class, $icDocumentosPerfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($icDocumentosPerfil);
            $entityManager->flush();

            return $this->redirectToRoute('ic_documentos_perfil_index');
        }

        return $this->render('ic_documentos_perfil/new.html.twig', [
            'ic_documentos_perfil' => $icDocumentosPerfil,
            'form' => $form->createView(),
        ]);
    }

  
    public function show(IcDocumentosPerfil $icDocumentosPerfil): Response
    {
        return $this->render('ic_documentos_perfil/show.html.twig', [
            'ic_documentos_perfil' => $icDocumentosPerfil,
        ]);
    }

  
    public function edit(Request $request, IcDocumentosPerfil $icDocumentosPerfil): Response
    {
        $form = $this->createForm(IcDocumentosPerfilType::class, $icDocumentosPerfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ic_documentos_perfil_index');
        }

        return $this->render('ic_documentos_perfil/edit.html.twig', [
            'ic_documentos_perfil' => $icDocumentosPerfil,
            'form' => $form->createView(),
        ]);
    }

    public function delete(Request $request, IcDocumentosPerfil $icDocumentosPerfil): Response
    {
        if ($this->isCsrfTokenValid('delete'.$icDocumentosPerfil->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($icDocumentosPerfil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ic_documentos_perfil_index');
    }
}
