<?php

namespace App\Service;

use App\Controller\ApiController;
use App\Entity\IcCentroCosto;
use App\Entity\IcCentroOrganizativoDireccion;
use App\Entity\IcCuentaContable;
use App\Entity\IcDireccion;
use App\Entity\IcSolicitud;
use App\Entity\IcTipoSolicitud;
use App\Entity\IcTorneo;
use App\Entity\IcTorneoCategoria;
use App\Entity\IcTorneoJornada;
use App\Helpers\IcProfileTrait;
use App\Repository\IcAreaRepository;
use Symfony\Component\HttpFoundation\JsonResponse;


class IcJsonService
{
    use IcProfileTrait;


    public function getCuentasContables(ApiController $api )
    {
        try {

            $cuenta = $this->entityManager->getRepository(IcCuentaContable::class)
                ->getCuentaContable($this->profile()->getIdDireccion()->getIdDireccion());
            return $api->responseIc($cuenta);

        } catch (\Exception $e) {

            return $api->responseWithErrors('Ocurrio un error al obtener las cuentas contables  ' . $e->getMessage());

        }
    }

    /**
     * @param int $centro
     * @return JsonResponse
     */
    public function getListas(int $centro, ApiController  $api ):JsonResponse
    {
        try {

            if ($centro == 'co') {
                $co = $this->entityManager->getRepository(IcCentroOrganizativoDireccion::class)
                    ->getFindByWhere(['idDireccion', $centro], true );

                return $api->responseIc(['co' => $co]);
            }

            if ($centro  == 'cc'){
                $cc = $this->entityManager->getRepository(IcCentroCosto::class)
                    ->getFindByWhere(array('idCentroOrganizativo' , $centro), true );
                return $api->responseIc(['cc' => $cc]);

            }

            $direccion = $this->entityManager->getRepository(IcDireccion::class)
                ->getFindByWhere(array('idDireccion' ,$this->profile()->getIdDireccion()->getIdDireccion()), true);
            return $api->responseIc(['direccion' => $direccion]);

        } catch (\Exception $e) {
            return $api->responseWithErrors('Al obtener la lista de centro costo, centro organizativo y direccion');
        }
    }

    /**
     * @param int $centro
     * @return JsonResponse
     */
    public function getDireccion($direccion, ApiController  $api ):JsonResponse
    {
        try {

            $data = $this->entityManager->getRepository(IcDireccion::class)
                ->getFindByWhere(array('idDireccion' , $direccion ), true);

            return $api->responseIc(['direccion' => $data]);

        } catch (\Exception $e) {
            return $api->responseWithErrors('Al obtener la lista de centro costo, centro organizativo y direccion');
        }
    }


    /**
     * @param int $centroCosto
     * @return JsonResponse
     */
    public function getCentroCosto(int $centroCosto, ApiController  $api):JsonResponse //Request $request, IcCentroCostoRepository  $centroCostoRepository )
    {
        try {
            if ($centroCosto) {
                $cc = $this->entityManager->getRepository(IcCentroCosto::class)
                    ->getFindByWhere(array('idCentroOrganizativo' ,$centroCosto), true );
                return $api->responseIc(['cc' => $cc]);
            }

        } catch (\Exception $e) {
            return $api->responseWithErrors('Error al obgener el centro de costo');
        }
    }


    /**
     * @param int $centroOrganizativo
     * @return JsonResponse
     */
    public function getCentroOrganizativo(int $centroOrganizativo, ApiController  $api ):JsonResponse
    {
        try {
            if ($centroOrganizativo) {
                $co = $this->entityManager->getRepository(IcCentroOrganizativoDireccion::class)
                    ->getFindByWhere(['idDireccion', $centroOrganizativo], true );
                return $api->responseIc(['co' => $co]);
            }
        } catch (\Exception $e) {
            return $api->responseWithErrors('Error al obtener el centro organizativo');
        }
    }

    public function getTorneoCategoriaJornada(ApiController $api ):JsonResponse
    {
        try {

            $dataTorneo     = $this->entityManager->getRepository(IcTorneo::class)->transformAll();
            $dataCategoria  = $this->entityManager->getRepository(IcTorneoCategoria::class)->transformAll();
            $dataJornada    = $this->entityManager->getRepository(IcTorneoJornada::class)->transformAll();

            return $api->responseIc(['torneo' => $dataTorneo, 'categoria' => $dataCategoria, 'jornada' => $dataJornada]);

        } catch (\Exception $e) {
            return $api->responseWithErrors('Ocurrio un error al obtener el Torneo ');
        }
    }


    public function getTipoSolicitud(ApiController $api):JsonResponse
    {
        try {

            $solicitud = $this->entityManager->getRepository(IcTipoSolicitud::class)
            ->transformAll();
            return  $api->responseIc(['TipoSolicitud'=> $solicitud]);

        } catch (\Exception $e) {

            $this->addFlash('warning', 'Error al obtener las listas de solicitudes');
            return $api->responseWithErrors('Ocurrio un error al obtener la lista de Solicitudes ');
        }
    }


    /**
     * @param  $user
     * @param  $tipoSolicitud
     * @param  $json
     * @return JsonResponse
     */
    public function getSolicitudes($user, $tipoSolicitud, $json, ApiController $api):JsonResponse
    {
        try {
                $solicitudes = $this->entityManager->getRepository(IcSolicitud::class)
                    ->getAllSolicitudByType($user, $tipoSolicitud, $json);

            if(!$solicitudes){
                return $api->responseWithErrors('Error al procesar las solicitudes del Usuario ');
            }
            return $api->responseIc($solicitudes);

        } catch ( \Exception $e) {
            return $api->responseWithErrors('Error al procesar las solicitudes del Usuario ');
        }
    }

    public function getArea(IcAreaRepository $areaRepository)
    {
        try{

             $area = $areaRepository->transformAll();
            if($area)
                return $area;
            else
                return false;

        }catch ( \Exception $exception){
            return false;
        }
    }
}
