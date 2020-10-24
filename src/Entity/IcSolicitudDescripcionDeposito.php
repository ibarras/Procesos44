<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcSolicitudDescripcionDeposito
 *
 * @ORM\Table(name="ic_solicitud_descripcion_deposito", indexes={@ORM\Index(name="IDX_D484A48569D7761A", columns={"id_solicitud_descripcion"}), @ORM\Index(name="IDX_D484A485CB870C58", columns={"id_perfil_solicita"}), @ORM\Index(name="IDX_D484A485205491AC", columns={"id_perfil_autoriza"})})
 * @ORM\Entity
 */
class IcSolicitudDescripcionDeposito
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_solicitud_descripcion_deposito_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="beneficiario", type="string", length=255, nullable=false)
     */
    private $beneficiario;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tipo_gasto", type="string", length=255, nullable=true)
     */
    private $tipoGasto;

    /**
     * @var string
     *
     * @ORM\Column(name="cuenta", type="string", length=20, nullable=false, options={"fixed"=true})
     */
    private $cuenta;

    /**
     * @var string
     *
     * @ORM\Column(name="banco", type="string", length=100, nullable=false)
     */
    private $banco;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cantidad", type="string", length=15, nullable=true, options={"fixed"=true})
     */
    private $cantidad;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var bool
     *
     * @ORM\Column(name="es_activo", type="boolean", nullable=false)
     */
    private $esActivo = false;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_solicitud", type="integer", nullable=true)
     */
    private $idSolicitud;

    /**
     * @var \IcSolicitudDescripcion
     *
     * @ORM\ManyToOne(targetEntity="IcSolicitudDescripcion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_descripcion", referencedColumnName="id")
     * })
     */
    private $idSolicitudDescripcion;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_perfil_solicita", referencedColumnName="id_perfil")
     * })
     */
    private $idPerfilSolicita;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_perfil_autoriza", referencedColumnName="id_perfil")
     * })
     */
    private $idPerfilAutoriza;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeneficiario(): ?string
    {
        return $this->beneficiario;
    }

    public function setBeneficiario(string $beneficiario): self
    {
        $this->beneficiario = $beneficiario;

        return $this;
    }

    public function getTipoGasto(): ?string
    {
        return $this->tipoGasto;
    }

    public function setTipoGasto(?string $tipoGasto): self
    {
        $this->tipoGasto = $tipoGasto;

        return $this;
    }

    public function getCuenta(): ?string
    {
        return $this->cuenta;
    }

    public function setCuenta(string $cuenta): self
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    public function getBanco(): ?string
    {
        return $this->banco;
    }

    public function setBanco(string $banco): self
    {
        $this->banco = $banco;

        return $this;
    }

    public function getCantidad(): ?string
    {
        return $this->cantidad;
    }

    public function setCantidad(?string $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

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

    public function getIdSolicitud(): ?int
    {
        return $this->idSolicitud;
    }

    public function setIdSolicitud(?int $idSolicitud): self
    {
        $this->idSolicitud = $idSolicitud;

        return $this;
    }

    public function getIdSolicitudDescripcion(): ?IcSolicitudDescripcion
    {
        return $this->idSolicitudDescripcion;
    }

    public function setIdSolicitudDescripcion(?IcSolicitudDescripcion $idSolicitudDescripcion): self
    {
        $this->idSolicitudDescripcion = $idSolicitudDescripcion;

        return $this;
    }

    public function getIdPerfilSolicita(): ?IcFosPerfil
    {
        return $this->idPerfilSolicita;
    }

    public function setIdPerfilSolicita(?IcFosPerfil $idPerfilSolicita): self
    {
        $this->idPerfilSolicita = $idPerfilSolicita;

        return $this;
    }

    public function getIdPerfilAutoriza(): ?IcFosPerfil
    {
        return $this->idPerfilAutoriza;
    }

    public function setIdPerfilAutoriza(?IcFosPerfil $idPerfilAutoriza): self
    {
        $this->idPerfilAutoriza = $idPerfilAutoriza;

        return $this;
    }


}
