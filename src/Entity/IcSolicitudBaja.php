<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcSolicitudBaja
 *
 * @ORM\Table(name="ic_solicitud_baja", indexes={@ORM\Index(name="IDX_A0899D3516629C02", columns={"id_usuario_baja"}), @ORM\Index(name="IDX_A0899D359366C0A", columns={"id_usuario_solicitante"})})
 * @ORM\Entity
 */
class IcSolicitudBaja
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_solicitud_baja_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="finiquito", type="boolean", nullable=true)
     */
    private $finiquito;

    /**
     * @var string|null
     *
     * @ORM\Column(name="motivo_baja", type="string", length=255, nullable=true)
     */
    private $motivoBaja;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="herramienta_otorgada", type="string", length=255, nullable=true)
     */
    private $herramientaOtorgada;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var int|null
     *
     * @ORM\Column(name="estatus", type="integer", nullable=true)
     */
    private $estatus;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_baja", type="date", nullable=true)
     */
    private $fechaBaja;

    /**
     * @var string|null
     *
     * @ORM\Column(name="llave", type="string", length=255, nullable=true)
     */
    private $llave;

    /**
     * @var string|null
     *
     * @ORM\Column(name="archivo", type="string", length=255, nullable=true)
     */
    private $archivo;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_baja", referencedColumnName="id")
     * })
     */
    private $idUsuarioBaja;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_solicitante", referencedColumnName="id")
     * })
     */
    private $idUsuarioSolicitante;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFiniquito(): ?bool
    {
        return $this->finiquito;
    }

    public function setFiniquito(?bool $finiquito): self
    {
        $this->finiquito = $finiquito;

        return $this;
    }

    public function getMotivoBaja(): ?string
    {
        return $this->motivoBaja;
    }

    public function setMotivoBaja(?string $motivoBaja): self
    {
        $this->motivoBaja = $motivoBaja;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getHerramientaOtorgada(): ?string
    {
        return $this->herramientaOtorgada;
    }

    public function setHerramientaOtorgada(?string $herramientaOtorgada): self
    {
        $this->herramientaOtorgada = $herramientaOtorgada;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getEstatus(): ?int
    {
        return $this->estatus;
    }

    public function setEstatus(?int $estatus): self
    {
        $this->estatus = $estatus;

        return $this;
    }

    public function getFechaBaja(): ?\DateTimeInterface
    {
        return $this->fechaBaja;
    }

    public function setFechaBaja(?\DateTimeInterface $fechaBaja): self
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    public function getLlave(): ?string
    {
        return $this->llave;
    }

    public function setLlave(?string $llave): self
    {
        $this->llave = $llave;

        return $this;
    }

    public function getArchivo(): ?string
    {
        return $this->archivo;
    }

    public function setArchivo(?string $archivo): self
    {
        $this->archivo = $archivo;

        return $this;
    }

    public function getIdUsuarioBaja(): ?FosUser
    {
        return $this->idUsuarioBaja;
    }

    public function setIdUsuarioBaja(?FosUser $idUsuarioBaja): self
    {
        $this->idUsuarioBaja = $idUsuarioBaja;

        return $this;
    }

    public function getIdUsuarioSolicitante(): ?FosUser
    {
        return $this->idUsuarioSolicitante;
    }

    public function setIdUsuarioSolicitante(?FosUser $idUsuarioSolicitante): self
    {
        $this->idUsuarioSolicitante = $idUsuarioSolicitante;

        return $this;
    }


}
