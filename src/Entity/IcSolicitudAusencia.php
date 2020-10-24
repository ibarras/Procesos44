<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcSolicitudAusencia
 *
 * @ORM\Table(name="ic_solicitud_ausencia", indexes={@ORM\Index(name="IDX_FC484202BF46FDEE", columns={"id_area_solicitante"}), @ORM\Index(name="IDX_FC484202B052C3AA", columns={"id_perfil"}), @ORM\Index(name="IDX_FC484202205491AC", columns={"id_perfil_autoriza"})})
 * @ORM\Entity
 */
class IcSolicitudAusencia
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_solicitud_ausencia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_permiso", type="date", nullable=false)
     */
    private $fechaPermiso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="motivo", type="text", nullable=true)
     */
    private $motivo;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_ausencia", type="string", length=255, nullable=false)
     */
    private $tipoAusencia;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="con_sueldo", type="boolean", nullable=true)
     */
    private $conSueldo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_regreso", type="date", nullable=false)
     */
    private $fechaRegreso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nota", type="text", nullable=true)
     */
    private $nota;

    /**
     * @var string|null
     *
     * @ORM\Column(name="documento", type="string", length=255, nullable=true)
     */
    private $documento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folio", type="string", length=255, nullable=true)
     */
    private $folio;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="estatus", type="boolean", nullable=true)
     */
    private $estatus;

    /**
     * @var \IcArea
     *
     * @ORM\ManyToOne(targetEntity="IcArea")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_solicitante", referencedColumnName="id_area")
     * })
     */
    private $idAreaSolicitante;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_perfil", referencedColumnName="id_perfil")
     * })
     */
    private $idPerfil;

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

    public function getFechaPermiso(): ?\DateTimeInterface
    {
        return $this->fechaPermiso;
    }

    public function setFechaPermiso(\DateTimeInterface $fechaPermiso): self
    {
        $this->fechaPermiso = $fechaPermiso;

        return $this;
    }

    public function getMotivo(): ?string
    {
        return $this->motivo;
    }

    public function setMotivo(?string $motivo): self
    {
        $this->motivo = $motivo;

        return $this;
    }

    public function getTipoAusencia(): ?string
    {
        return $this->tipoAusencia;
    }

    public function setTipoAusencia(string $tipoAusencia): self
    {
        $this->tipoAusencia = $tipoAusencia;

        return $this;
    }

    public function getConSueldo(): ?bool
    {
        return $this->conSueldo;
    }

    public function setConSueldo(?bool $conSueldo): self
    {
        $this->conSueldo = $conSueldo;

        return $this;
    }

    public function getFechaRegreso(): ?\DateTimeInterface
    {
        return $this->fechaRegreso;
    }

    public function setFechaRegreso(\DateTimeInterface $fechaRegreso): self
    {
        $this->fechaRegreso = $fechaRegreso;

        return $this;
    }

    public function getNota(): ?string
    {
        return $this->nota;
    }

    public function setNota(?string $nota): self
    {
        $this->nota = $nota;

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

    public function getFolio(): ?string
    {
        return $this->folio;
    }

    public function setFolio(?string $folio): self
    {
        $this->folio = $folio;

        return $this;
    }

    public function getEstatus(): ?bool
    {
        return $this->estatus;
    }

    public function setEstatus(?bool $estatus): self
    {
        $this->estatus = $estatus;

        return $this;
    }

    public function getIdAreaSolicitante(): ?IcArea
    {
        return $this->idAreaSolicitante;
    }

    public function setIdAreaSolicitante(?IcArea $idAreaSolicitante): self
    {
        $this->idAreaSolicitante = $idAreaSolicitante;

        return $this;
    }

    public function getIdPerfil(): ?IcFosPerfil
    {
        return $this->idPerfil;
    }

    public function setIdPerfil(?IcFosPerfil $idPerfil): self
    {
        $this->idPerfil = $idPerfil;

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
