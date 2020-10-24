<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcSolicitudEvaluacionContrato
 *
 * @ORM\Table(name="ic_solicitud_evaluacion_contrato", indexes={@ORM\Index(name="IDX_9CDB275AFCF8192D", columns={"id_usuario"})})
 * @ORM\Entity
 */
class IcSolicitudEvaluacionContrato
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_solicitud_evaluacion_contrato_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string|null
     *
     * @ORM\Column(name="laboriosidad", type="string", length=255, nullable=true)
     */
    private $laboriosidad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="habilidad_aprender", type="string", length=255, nullable=true)
     */
    private $habilidadAprender;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comportamiento", type="string", length=255, nullable=true)
     */
    private $comportamiento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="eficiencia", type="string", length=255, nullable=true)
     */
    private $eficiencia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="iniciativa", type="string", length=255, nullable=true)
     */
    private $iniciativa;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sugerencias", type="string", length=255, nullable=true)
     */
    private $sugerencias;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_recibido", type="date", nullable=true)
     */
    private $fechaRecibido;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacion_resolucion", type="text", nullable=true)
     */
    private $observacionResolucion;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_perfil")
     * })
     */
    private $idUsuario;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLaboriosidad(): ?string
    {
        return $this->laboriosidad;
    }

    public function setLaboriosidad(?string $laboriosidad): self
    {
        $this->laboriosidad = $laboriosidad;

        return $this;
    }

    public function getHabilidadAprender(): ?string
    {
        return $this->habilidadAprender;
    }

    public function setHabilidadAprender(?string $habilidadAprender): self
    {
        $this->habilidadAprender = $habilidadAprender;

        return $this;
    }

    public function getComportamiento(): ?string
    {
        return $this->comportamiento;
    }

    public function setComportamiento(?string $comportamiento): self
    {
        $this->comportamiento = $comportamiento;

        return $this;
    }

    public function getEficiencia(): ?string
    {
        return $this->eficiencia;
    }

    public function setEficiencia(?string $eficiencia): self
    {
        $this->eficiencia = $eficiencia;

        return $this;
    }

    public function getIniciativa(): ?string
    {
        return $this->iniciativa;
    }

    public function setIniciativa(?string $iniciativa): self
    {
        $this->iniciativa = $iniciativa;

        return $this;
    }

    public function getSugerencias(): ?string
    {
        return $this->sugerencias;
    }

    public function setSugerencias(?string $sugerencias): self
    {
        $this->sugerencias = $sugerencias;

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

    public function getFechaRecibido(): ?\DateTimeInterface
    {
        return $this->fechaRecibido;
    }

    public function setFechaRecibido(?\DateTimeInterface $fechaRecibido): self
    {
        $this->fechaRecibido = $fechaRecibido;

        return $this;
    }

    public function getObservacionResolucion(): ?string
    {
        return $this->observacionResolucion;
    }

    public function setObservacionResolucion(?string $observacionResolucion): self
    {
        $this->observacionResolucion = $observacionResolucion;

        return $this;
    }

    public function getIdUsuario(): ?IcFosPerfil
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?IcFosPerfil $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }


}
