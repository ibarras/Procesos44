<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IcSolicitud
 *
 * @ORM\Table(name="ic_solicitud", indexes={@ORM\Index(name="IDX_3FDCD56457577DBC", columns={"id_centro_costo"}),
 *     @ORM\Index(name="IDX_3FDCD56462CA3EBB", columns={"id_centro_organizativo"}),
 *     @ORM\Index(name="IDX_3FDCD56473B102B2", columns={"id_direccion"}),
 *     @ORM\Index(name="IDX_3FDCD564BF4FB5CF", columns={"id_jornada"}),
 *     @ORM\Index(name="IDX_3FDCD56449DA7E88", columns={"id_tipo_solicitud"}),
 *      @ORM\Index(name="IDX_3FDCD5645ADCD613", columns={"id_torneo"}),
 *      @ORM\Index(name="IDX_3FDCD5647E1F64C2", columns={"id_torneo_categoria"}) })
 *

 * @ORM\Entity
* @ORM\Entity(repositoryClass="App\Repository\IcSolicitudRepository")
 * 
 */
class IcSolicitud
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_solicitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     * @Assert\NotNull
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_transferencia", type="date", nullable=true)
     */
    private $fechaTransferencia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="forma_de_pago", type="string", length=100, nullable=true)
     */
    private $formaDePago;

    /**
     * @var string|null
     *
     * @ORM\Column(name="numero_tarjeta", type="string", length=50, nullable=true)
     */
    private $numeroTarjeta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="motivo_de_gasto", type="string", length=100, nullable=true)
     */
    private $motivoDeGasto;

    /**
     * @var string|null
     *
     * @ORM\Column(name="informe", type="string", length=200, nullable=true)
     */
    private $informe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="importe", type="string", length=10, nullable=true)
     */
    private $importe;

    /**
     * @var bool
     * @Assert\NotNull
     * @ORM\Column(name="es_activo", type="boolean", nullable=false)
     */
    private $esActivo = false;

    /**
     * @var \IcCentroCosto
     *
     * @ORM\ManyToOne(targetEntity="IcCentroCosto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_costo", referencedColumnName="id")
     * })
     */
    private $idCentroCosto;

    /**
     * @var \IcCentroOrganizativoDireccion
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="IcCentroOrganizativoDireccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_organizativo", referencedColumnName="id")
     * })
     */
    private $idCentroOrganizativo;

    /**
     * @var \IcDireccion
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="IcDireccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_direccion", referencedColumnName="id_direccion")
     * })
     */
    private $idDireccion;

    /**
     * @var \IcTorneoJornada
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="IcTorneoJornada")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_jornada", referencedColumnName="id")
     * })
     */
    private $idJornada;

    /**
     * @var \IcTipoSolicitud
     *
     * @ORM\ManyToOne(targetEntity="IcTipoSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_solicitud", referencedColumnName="id")
     * })
     */
    private $idTipoSolicitud;

    /**
     * @var \IcTorneo
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="IcTorneo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_torneo", referencedColumnName="id")
     * })
     */
    private $idTorneo;

    /**
     * @var \IcTorneoCategoria
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="IcTorneoCategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_torneo_categoria", referencedColumnName="id")
     * })
     */
    private $idTorneoCategoria;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_autoriza", referencedColumnName="id", nullable=true)
     * })
     */
    private $idUsuarioAutoriza;


    /**
     * @var \FosUser
     * @Assert\NotNull
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_solicita", referencedColumnName="id", nullable=false)
     * })
     */
    private $idUsuarioSolicita;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getFechaTransferencia(): ?\DateTimeInterface
    {
        return $this->fechaTransferencia;
    }

    public function setFechaTransferencia(?\DateTimeInterface $fechaTransferencia): self
    {
        $this->fechaTransferencia = $fechaTransferencia;

        return $this;
    }

    public function getFormaDePago(): ?string
    {
        return $this->formaDePago;
    }

    public function setFormaDePago(?string $formaDePago): self
    {
        $this->formaDePago = $formaDePago;

        return $this;
    }

    public function getNumeroTarjeta(): ?string
    {
        return $this->numeroTarjeta;
    }

    public function setNumeroTarjeta(?string $numeroTarjeta): self
    {
        $this->numeroTarjeta = $numeroTarjeta;

        return $this;
    }

    public function getMotivoDeGasto(): ?string
    {
        return $this->motivoDeGasto;
    }

    public function setMotivoDeGasto(?string $motivoDeGasto): self
    {
        $this->motivoDeGasto = $motivoDeGasto;

        return $this;
    }

    public function getInforme(): ?string
    {
        return $this->informe;
    }

    public function setInforme(?string $informe): self
    {
        $this->informe = $informe;

        return $this;
    }

    public function getImporte(): ?string
    {
        return $this->importe;
    }

    public function setImporte(?string $importe): self
    {
        $this->importe = $importe;

        return $this;
    }

    public function getEsActivo(): ?bool
    {
        return $this->esActivo;
    }

    public function setEsActivo(bool $esActivo): self
    {
        $this->esActivo = $esActivo;

        return $this;
    }

    public function getIdCentroCosto(): ?IcCentroCosto
    {
        return $this->idCentroCosto;
    }

    public function setIdCentroCosto(?IcCentroCosto $idCentroCosto): self
    {
        $this->idCentroCosto = $idCentroCosto;

        return $this;
    }

    public function getIdCentroOrganizativo(): ?IcCentroOrganizativoDireccion
    {
        return $this->idCentroOrganizativo;
    }

    public function setIdCentroOrganizativo(?IcCentroOrganizativoDireccion $idCentroOrganizativo): self
    {
        $this->idCentroOrganizativo = $idCentroOrganizativo;

        return $this;
    }

    public function getIdDireccion(): ?IcDireccion
    {
        return $this->idDireccion;
    }

    public function setIdDireccion(?IcDireccion $idDireccion): self
    {
        $this->idDireccion = $idDireccion;

        return $this;
    }

    public function getIdJornada(): ?IcTorneoJornada
    {
        return $this->idJornada;
    }

    public function setIdJornada(?IcTorneoJornada $idJornada): self
    {
        $this->idJornada = $idJornada;

        return $this;
    }

    public function getIdTipoSolicitud(): ?IcTipoSolicitud
    {
        return $this->idTipoSolicitud;
    }

    public function setIdTipoSolicitud(?IcTipoSolicitud $idTipoSolicitud): self
    {
        $this->idTipoSolicitud = $idTipoSolicitud;

        return $this;
    }

    public function getIdTorneo(): ?IcTorneo
    {
        return $this->idTorneo;
    }

    public function setIdTorneo(?IcTorneo $idTorneo): self
    {
        $this->idTorneo = $idTorneo;

        return $this;
    }

    public function getIdTorneoCategoria(): ?IcTorneoCategoria
    {
        return $this->idTorneoCategoria;
    }

    public function setIdTorneoCategoria(?IcTorneoCategoria $idTorneoCategoria): self
    {
        $this->idTorneoCategoria = $idTorneoCategoria;

        return $this;
    }

    public function getIdUsuarioAutoriza(): ?FosUser
    {
        return $this->idUsuarioAutoriza;
    }

    public function setIdUsuarioAutoriza(?FosUser $idUsuarioAutoriza): self
    {
        $this->idUsuarioAutoriza = $idUsuarioAutoriza;

        return $this;
    }

    public function getIdUsuarioSolicita(): ?FosUser
    {
        return $this->idUsuarioSolicita;
    }

    public function setIdUsuarioSolicita(?FosUser $idUsuarioSolicita): self
    {
        $this->idUsuarioSolicita = $idUsuarioSolicita;

        return $this;
    }


}
