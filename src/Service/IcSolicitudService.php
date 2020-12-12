<?php

namespace App\Service;

use App\Entity\FosUser;
use App\Entity\IcFosPerfil;
use App\Helpers\IcProfileTrait;
use App\Entity\IcCentroCosto;
use App\Entity\IcCentroOrganizativoDireccion;
use App\Entity\IcCuentaContable;
use App\Entity\IcDireccion;
use App\Entity\IcSolicitud;
use App\Entity\IcTipoSolicitud;
use App\Entity\IcTorneo;
use App\Entity\IcTorneoCategoria;
use App\Entity\IcTorneoJornada;
use App\Entity\IcSolicitudDescripcion;
use App\Entity\IcSolicitudDescripcionDeposito;

use App\Repository\IcSolicitudRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;

class IcSolicitudService
{
    use IcProfileTrait;


    /**
     * @param $array
     * @param ValidatorInterface $validator
     * @param $usuario
     * @return IcSolicitud|false
     */
    public function addSolicitud($array, ValidatorInterface $validator, $usuario)
    {
        try {
            $array['TipoDeInforme'] = 1;

            $direccion = $this->entityManager->getRepository(IcDireccion::class)
                ->find(array('idDireccion' => $this->profile()->getIdDireccion()));

            $tipo = $this->entityManager->getRepository(IcTipoSolicitud::class)
                ->find(1);

            $torneo = $this->entityManager->getRepository(IcTorneo::class)
                ->find($array['Torneo']);

            $categoria = $this->entityManager->getRepository(IcTorneoCategoria::class)
                ->find($array['Categoria']);

            $jornada = $this->entityManager->getRepository(IcTorneoJornada::class)
                ->find($array['Jornada']);

            $centroCosto = $this->entityManager->getRepository(IcCentroCosto::class)
                ->find($array['CentroDeCosto']);

            $centroOrganizativo = $this->entityManager->getRepository(IcCentroOrganizativoDireccion::class)
                ->find($array['CentroOrganizativo']);

            //$array['TipoDeInforme'] = 1;
            $fechaTransferencia = new \DateTime($array['FechaDePago']);
            $tarjeta = empty($array['NumeroDeTarjeta'])? 'NA': $array['NumeroDeTarjeta'];

            $solicitud = new IcSolicitud();
            $solicitud->setIdDireccion($direccion);
            $solicitud->setIdUsuarioSolicita($usuario );
            $solicitud->setIdTipoSolicitud($tipo);
            $solicitud->setIdTorneo($torneo);
            $solicitud->setIdTorneoCategoria($categoria);
            $solicitud->setIdJornada($jornada);
            $solicitud->setIdCentroCosto($centroCosto);
            $solicitud->setIdCentroOrganizativo($centroOrganizativo);
            $solicitud->setFecha(new \DateTime('now'));
            $solicitud->setFechaTransferencia($fechaTransferencia);
            $solicitud->setFormaDePago($array['FormaDePago']);
            $solicitud->setNumeroTarjeta($tarjeta);
            $solicitud->setMotivoDeGasto($array['MotivoDeLaCompra']);
            $solicitud->setInforme($array['TipoDeInforme']); // Fix nombre  Tipo? que mergas
            $solicitud->setImporte($array['Importe']);
            $solicitud->setEsActivo(false);

            $errors = $validator->validate($solicitud);
            if (count($errors) > 0)
                return false;

            $this->entityManager->persist($solicitud);
            $this->entityManager->flush();

            return $solicitud;

        } catch (\Exception $e) {
            return false;
        }
    }


    /**
     * @param $stdClass
     * @param IcSolicitud $solicitud
     * @return IcSolicitudDescripcion|false
     */
    public function addDescripcionSolicitud($stdClass, IcSolicitud $solicitud)
    {
        $cuentaContable = $this->entityManager->getRepository(IcCuentaContable::class)
            ->find($stdClass->Cuenta);

        $variacion = $stdClass->Presupuesto - $stdClass->Real;

        $descripcion = new IcSolicitudDescripcion();
        $descripcion->setDescripcion($stdClass->Facturado);
        $descripcion->setIdCuentaContable($cuentaContable);
        $descripcion->setTipoDeGasto($stdClass->Facturado);
        $descripcion->setPresupuesto($stdClass->Presupuesto);
        $descripcion->setPrecioReal($stdClass->Real);
        $descripcion->setVariacion($variacion);
        $descripcion->setTotal($variacion);
        $descripcion->setDeposito($solicitud->getImporte());
        //$descripcion->setSaldo('i');
        $descripcion->setRetirarSaldo(false);
        $descripcion->setObservaciones('Observaciones');
        $descripcion->setIdSolicitud($solicitud);
        $descripcion->setEsActivo(true);

        $this->entityManager->persist($descripcion);
        $this->entityManager->flush();

        if($descripcion instanceof IcSolicitudDescripcion ){
            return $descripcion;
        }else{
            return false;
        }
    }

    /**
     * @param Request $request
     * @return IcSolicitudDescripcionDeposito
     */
    public function addSolicitudDescripcionDeposito(Request $request) //work
    {
        $json = $this->get('jms_serializer');
        $post = $request->getContent();
        $info = json_decode($post);

        try {

            if (empty($post)) {
                return $this->render('@Procesos/icsolicitudegresos/agregar.html.twig');
            }

            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction(); // suspend auto-commit
            /**
             * Se actualiza primero la tabla deposito y despues la tabla descripcion
             *
             */

            //Objecto para actualizar
            $egreso = $em->getRepository('ProcesosBundle:IcSolicitudDescripcion')->findOneBy(array('id' => $info->Deposito));
            $perfil = $em->getRepository('ProcesosBundle:IcFosPerfil')->findOneBy(array('idPerfil' => $this->getUser()->getIdPerfil()));
            //Objeto para agregar deposito
            $deposito = new IcSolicitudDescripcionDeposito();

            $deposito->setBeneficiario($info->Proveedor);
            $deposito->setTipoGasto($info->TipoGasto);
            $deposito->setCuenta($info->CuentaClabe);
            $deposito->setBanco($info->Banco);
            $deposito->setIdSolicitud($egreso->getIdSolicitud());
            /**
             * La cantidad debe ser igual al precio real, de la tabla descripcion.
             */
            $deposito->setCantidad($egreso->getPrecioReal());
            $deposito->setIdPerfilSolicita($perfil);
            $deposito->setFecha(new \DateTime('now'));
            $deposito->setIdSolicitudDescripcion($egreso); //setIdEgresoDescripcion($egreso);
            $deposito->setEsActivo(true);

            $egreso->setEsActivo(false);
            $em->persist($egreso);

            $em->persist($deposito);
            $em->flush();
            $em->getConnection()->commit();

            return $deposito;


        } catch ( Exception $e) {
            $this->addFlash('danger', 'Ocurrio un error al dar de alta el deposito, [IcSolicitud]' .
                $e->getMessage());
        }
        return $this->render('@App/icsolicitudegresos/show.html.twig');
    }


    /**
     * Metodo para obtener la informacion de una solicitud / descripcion / deposito [ Solicitud de Egreso ]
     * @param IcSolicitud $solicitud
     * @return array
     */
    public function getSolicitud(IcSolicitud $solicitud)
    {
        try{

            $total          = 0;
            $presupuesto    = 0;
            $real           = 0;
            $variacion      = 0;
            $totalDeposito  = 0;

            $dataSolicitud = $this->entityManager->getRepository(IcSolicitud::class)->transform($solicitud);

            $descripcion = $this->entityManager->getRepository(IcSolicitudDescripcion::class)
                ->findBy(array('idSolicitud' => $solicitud->getId() ), array('id' => 'DESC'));

            $depositos = [];
            foreach ($descripcion as $d ){
                $depositos[]  = $d->getId();
            }

            $deposito = $this->entityManager->getRepository(IcSolicitudDescripcionDeposito::class)
               // ->findBy(array('idSolicitudDescripcion' => $d->getId()),  array('id' => 'DESC'));
                    ->getDepositos($depositos);


            if($descripcion){
                $dataDescripcion = $this->entityManager->getRepository(IcSolicitudDescripcion::class)
                    ->transformAll($descripcion);

                foreach ($descripcion as $a) {
                    $total       += $a->getTotal();
                    $presupuesto += $a->getPresupuesto();
                    $real        += $a->getPrecioReal();
                    $variacion   += $a->getVariacion();
                }
            }else{
                $dataDescripcion = array('warning' => 'No existe descripcion de solicitud ');
            }

            if($deposito){
                $dataDeposito = $this->entityManager->getRepository(IcSolicitudDescripcionDeposito::class)
                    ->transformAll($deposito);

                foreach ($deposito as $d) {
                    $totalDeposito += trim($d->getCantidad());
                }
            }else{
                $dataDeposito = array('warning' => 'No existe deposito de solicitud ');
            }

            $totales = array(
                'total'         => $total,
                'presupuesto'   => $presupuesto,
                'real'          => $real,
                'variacion'     => $variacion,
            );

            $saldo      = round(($solicitud->getImporte() - $real),2);
            $retirar    = ($solicitud->getImporte() > $real) ? 'SI' : 'NO';
            $importe    = $solicitud->getImporte();

            if(!$deposito) {

                return array('solicitud' => $dataSolicitud,
                    'descripcion'        => $dataDescripcion,
                    'totales'            => $totales,
                    'saldo'              => $saldo,
                    'retirar'            => $retirar,
                    'importe'            => $importe
                );
            }
            return array('solicitud' => $dataSolicitud,
                'descripcion'        => $dataDescripcion,
                'totales'            => $totales,
                'saldo'              => $saldo,
                'deposito'           => $dataDeposito,
                'totalDeposito'      => $totalDeposito,
                'retirar'            => $retirar,
                'importe'            => $importe
            );

        }catch(\Exception $e){
            printf('%s, ERROR SOLICITUDSERVICE ', $e->getMessage());
        }
    }

    /**
     *
     * @param $usuario si no se recive el parametro usuario, se retornaran todas las solicitudes en general del tipo que busque
     * @param $tipos_solicitud
     * @return JsonResponse
     */
    public function getSolicitudes($usuario, $tipos_solicitud)
    {
        try {
            if($usuario){
                $solicitudes = $this->entityManager->getRepository(IcSolicitud::class)
                    ->getAllSolicitudByType($usuario, $tipos_solicitud, $object = true );

                if(!$solicitudes){
                    $this->addFlash('danger', 'No existe informacion que busca');
                }
                return  new JsonResponse($solicitudes, 200, array('Content-Type' => 'application/json'));

            }else if(!$usuario){
                $solicitudes = $this->entityManager->getRepository(IcSolicitud::class)
                    ->transformAll();

                if(!$solicitudes){
                    $this->addFlash('danger', 'No existe informacion que busca');
                }
                return  new JsonResponse($solicitudes, 200, array('Content-Type' => 'application/json'));
            }


        } catch ( \Exception $e) {
            return new JsonResponse('error' , 'Error al procesar las solicitudes del Usuario ');
        }
    }

    /**
     * @param IcSolicitudDescripcionDeposito $deposito
     * @return bool
     */
    public function getDeleteDeposito(IcSolicitudDescripcionDeposito $deposito )
    {
        try{
            if($deposito){
                $this->entityManager->remove($deposito);
                $this->entityManager->flush();
                return true;
            }

        }catch (\Exception $exception){
            return false;
        }
    }

    /**
     * @param IcSolicitudDescripcion $descripcion
     * @param null $flag
     * @return bool
     */
    public function getDeleteDescripcion(IcSolicitudDescripcion $descripcion, $flag = null )
    {
        try{
            if($descripcion){

                $depositos = $this->entityManager->getRepository(IcSolicitudDescripcionDeposito::class)
                    ->findBy(array('idSolicitudDescripcion' => $descripcion->getId()));

                if(count($depositos) > 0){
                    foreach ($depositos as $d){
                        $this->entityManager->remove($d);
                    }
                }

                $this->entityManager->remove($descripcion);
                $this->entityManager->flush();

                return true;
            }

        }catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param IcSolicitud $solicitud
     * @return bool
     */
    public function getDeleteSolicitud(IcSolicitud $solicitud)
    {
        try{
            if($solicitud){

                $informacion = $this->entityManager->getRepository(IcSolicitudDescripcion::class)
                    ->findBy(array('idSolicitud' => $solicitud->getId()));

                if(count($informacion) > 0 ){
                    foreach ($informacion as $i){
                        $i = $this->getDeleteDescripcion($i, true );
                        if(!$i){
                            return false;
                        }
                    }
                }

                $this->entityManager->remove($solicitud);
                $this->entityManager->flush();
                return true;
            }
        }catch (\Exception $exception){
            return false;
        }
    }




}
