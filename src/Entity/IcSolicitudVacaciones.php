<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcSolicitudVacaciones
 *
 * @ORM\Table(name="ic_solicitud_vacaciones", indexes={@ORM\Index(name="IDX_5E089CA7FCF8192D", columns={"id_usuario"}), @ORM\Index(name="IDX_5E089CA72EFCD0C9", columns={"id_usuario_autoriza"})})
 * @ORM\Entity
 */
class IcSolicitudVacaciones
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_solicitud_vacaciones_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_desde", type="date", nullable=false)
     */
    private $fechaDesde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hasta", type="date", nullable=false)
     */
    private $fechaHasta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tipo_permiso", type="string", length=255, nullable=true)
     */
    private $tipoPermiso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dias_vacaciones", type="string", length=255, nullable=true)
     */
    private $diasVacaciones;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firma_autorizacion", type="string", length=255, nullable=true)
     */
    private $firmaAutorizacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="documento", type="string", length=255, nullable=true)
     */
    private $documento;

    /**
     * @var bool
     *
     * @ORM\Column(name="estatus", type="boolean", nullable=false)
     */
    private $estatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folio", type="string", length=255, nullable=true)
     */
    private $folio;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     * })
     */
    private $idUsuario;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_autoriza", referencedColumnName="id")
     * })
     */
    private $idUsuarioAutoriza;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaDesde(): ?\DateTimeInterface
    {
        return $this->fechaDesde;
    }

    public function setFechaDesde(\DateTimeInterface $fechaDesde): self
    {
        $this->fechaDesde = $fechaDesde;

        return $this;
    }

    public function getFechaHasta(): ?\DateTimeInterface
    {
        return $this->fechaHasta;
    }

    public function setFechaHasta(\DateTimeInterface $fechaHasta): self
    {
        $this->fechaHasta = $fechaHasta;

        return $this;
    }

    public function getTipoPermiso(): ?string
    {
        return $this->tipoPermiso;
    }

    public function setTipoPermiso(?string $tipoPermiso): self
    {
        $this->tipoPermiso = $tipoPermiso;

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

    public function getDiasVacaciones(): ?string
    {
        return $this->diasVacaciones;
    }

    public function setDiasVacaciones(?string $diasVacaciones): self
    {
        $this->diasVacaciones = $diasVacaciones;

        return $this;
    }

    public function getFirmaAutorizacion(): ?string
    {
        return $this->firmaAutorizacion;
    }

    public function setFirmaAutorizacion(?string $firmaAutorizacion): self
    {
        $this->firmaAutorizacion = $firmaAutorizacion;

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

    public function getEstatus(): ?bool
    {
        return $this->estatus;
    }

    public function setEstatus(bool $estatus): self
    {
        $this->estatus = $estatus;

        return $this;
    }

    public function getFechaSolicitud(): ?\DateTimeInterface
    {
        return $this->fechaSolicitud;
    }

    public function setFechaSolicitud(\DateTimeInterface $fechaSolicitud): self
    {
        $this->fechaSolicitud = $fechaSolicitud;

        return $this;
    }

    public function getFolio(): ?string
    {
        return $this->folio;
    }

    public function setFolio(?string $folio): self
    {
        $this->folio = $folio;

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

    public function getIdUsuarioAutoriza(): ?FosUser
    {
        return $this->idUsuarioAutoriza;
    }

    public function setIdUsuarioAutoriza(?FosUser $idUsuarioAutoriza): self
    {
        $this->idUsuarioAutoriza = $idUsuarioAutoriza;

        return $this;
    }


}
