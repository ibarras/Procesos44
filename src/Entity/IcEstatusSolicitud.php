<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcEstatusSolicitud
 *
 * @ORM\Table(name="ic_estatus_solicitud", indexes={@ORM\Index(name="IDX_7511EB7FCF8192D", columns={"id_usuario"})})
 * @ORM\Entity
 */
class IcEstatusSolicitud
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_estatus_solicitud", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_estatus_solicitud_id_estatus_solicitud_seq", allocationSize=1, initialValue=1)
     */
    private $idEstatusSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="estatus", type="string", length=255, nullable=false)
     */
    private $estatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="folio", type="string", length=255, nullable=false)
     */
    private $folio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firma", type="string", length=255, nullable=true)
     */
    private $firma;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var string|null
     *
     * @ORM\Column(name="documento", type="string", length=255, nullable=true)
     */
    private $documento;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     * })
     */
    private $idUsuario;

    public function getIdEstatusSolicitud(): ?int
    {
        return $this->idEstatusSolicitud;
    }

    public function getEstatus(): ?string
    {
        return $this->estatus;
    }

    public function setEstatus(string $estatus): self
    {
        $this->estatus = $estatus;

        return $this;
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

    public function getFolio(): ?string
    {
        return $this->folio;
    }

    public function setFolio(string $folio): self
    {
        $this->folio = $folio;

        return $this;
    }

    public function getFirma(): ?string
    {
        return $this->firma;
    }

    public function setFirma(?string $firma): self
    {
        $this->firma = $firma;

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

    public function getDocumento(): ?string
    {
        return $this->documento;
    }

    public function setDocumento(?string $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    public function getIdUsuario(): ?FosUser
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?FosUser $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }


}
