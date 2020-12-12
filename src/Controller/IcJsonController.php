<?php

namespace App\Controller;

use App\Entity\IcSolicitud;
use App\Helpers\IcProfileTrait;
use App\Repository\IcCentroCostoRepository;
use App\Repository\IcCentroOrganizativoRepository;
use App\Repository\IcCuentaContableRepository;
use App\Repository\IcDireccionRepository;
use App\Repository\IcSolicitudRepository;
use App\Repository\IcTipoSolicitudRepository;
use App\Repository\IcTorneoCategoriaRepository;
use App\Repository\IcTorneoJornadaRepository;
use App\Repository\IcTorneoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class IcJsonController
{
    use IcProfileTrait;

    public function getCuentasContables(Request $request, IcCuentaContableRepository $cuentaContableRepository)
    {
        try {
            $cuenta =  $cuentaContableRepository->getCuentaContable($this->profile()->getIdDireccion()->getIdDireccion());
            return new JsonResponse($cuenta, 200, array('Content-Type' => 'application/json'));

        } catch (\Exception $e) {
            return new JsonResponse(array('error' => 'Ocurrio un error al obtener las cuentas contables  ' . $e->getMessage()));
        }
    }

    public function getListas(Request $request, IcDireccionRepository $direccionRepository,
                              IcCentroCostoRepository  $centroCostoRepository, IcCentroOrganizativoRepository $centroOrganizativoRepository)
    {
        try {

            if ($request->get('co')) {
                $co = $centroOrganizativoRepository->getFindByWhere(['idDireccion', $request->get('idDireccion')], true );
                return new JsonResponse(['co' => $co], 200, array('Content-Type' => 'application/json'));
            }

            if ($request->get('cc')) {
                $cc = $centroCostoRepository->getFindByWhere(array('idCentroOrganizativo' , $request->get('idCentro')), true );
                return new JsonResponse(['cc' => $cc], 200, array('Content-Type' => 'application/json'));
            }

            $direccion = $direccionRepository->getFindByWhere(array('idDireccion' ,$this->profile()->getIdDireccion()->getIdDireccion()), true);

            return new JsonResponse(['direccion' => $direccion], 200, array('Content-Type' => 'application/json'));


        } catch (\Exception $e) {
            return new JsonResponse(['Error' => 'Al obtener la lista de centro costo, centro organizativo y direccion'],
                200, array('Content-Type' => 'application/json'));
        }
    }
    public function getCentroCosto(Request $request, IcCentroCostoRepository  $centroCostoRepository )
    {
        try {
            if ($request->get('cc')) {
                $cc = $centroCostoRepository->getFindByWhere(array('idCentroOrganizativo' , $request->get('idCentro')), true );
                return new JsonResponse(['cc' => $cc], 200, array('Content-Type' => 'application/json'));
            }

        } catch (\Exception $e) {
            return new JsonResponse(['Error' => 'Error al obgener el centro de costo'], 200, array('Content-Type' => 'application/json'));
        }
    }


    public function getCentroOrganizativo(Request $request, IcCentroOrganizativoRepository $centroOrganizativoRepository)
    {
        try {
            if ($request->get('co')) {
                $co = $centroOrganizativoRepository->getFindByWhere(['idDireccion', $request->get('idDireccion')], true );
                return new JsonResponse(['co' => $co], 200, array('Content-Type' => 'application/json'));
            }
        } catch (\Exception $e) {
            return new JsonResponse(['ERRO' => 'Error al obtener el centro organizativo'], 200, array('Content-Type' => 'application/json'));
        }
    }

    public function getTorneo(Request $request, IcTorneoRepository $icTorneoRepository, IcTorneoCategoriaRepository $torneoCategoriaRepository,
                              IcTorneoJornadaRepository $icTorneoJornadaRepository)
    {
        try {

            $dataTorneo   = $icTorneoRepository->transformAll();
            $dataCategoria = $torneoCategoriaRepository->transformAll();
            $dataJornada   = $icTorneoJornadaRepository->transformAll();

            return new JsonResponse(['torneo' => $dataTorneo, 'categoria' => $dataCategoria, 'jornada' => $dataJornada], 200, array('Content-Type' => 'application/json'));

        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Ocurrio un error al obtener el Torneo '], 200, array('Content-Type' => 'application/json'));
        }
    }


    public function getTipoSolicitud(Request $request, IcTipoSolicitudRepository $tipoSolicitudRepository)
    {
        try {

            $solicitud = $tipoSolicitudRepository->transformAll();
            return  new JsonResponse(['TipoSolicitud'=> $solicitud]);

        } catch (\Exception $e) {

            $this->addFlash('warning', 'Error al obtener las listas de solicitudes');
            return new JsonResponse(array('error' => 'Ocurrio un error al obtener la lista de Solicitudes ' . $e->getMessage()));
        }
    }
}
