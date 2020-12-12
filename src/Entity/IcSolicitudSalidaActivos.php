<?php

namespace App\Entity;

use App\Repository\IcSolicitudSalidaActivosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IcSolicitudSalidaActivosRepository::class)
 */
class IcSolicitudSalidaActivos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id", nullable=false)
     * })
     */
    private $id_usuario;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_autoriza", referencedColumnName="id", nullable=true)
     * })
     */
    private $id_usuario_autoriza;


    /**
     * @var \IcActivosFijos
     *
     * @ORM\ManyToOne(targetEntity="IcActivosFijos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_activo_fijo", referencedColumnName="id", nullable=false)
     * })
     */
    private $id_activo_fijo;


    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_autorizacion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_solicitud;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_salida;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_entrada;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estatus;

    /**
     * @ORM\Column(name="codigo_autorizacion", type="string", length=255)
     */
    private $codigo_autorizacion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notas;



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getIdUsuario(): ?FosUser
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(?FosUser $id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getIdUsuarioAutoriza(): ?FosUser
    {
        return $this->id_usuario_autoriza;
    }

    public function setIdUsuarioAutoriza(?FosUser $id_usuario_autoriza): self
    {
        $this->id_usuario_autoriza = $id_usuario_autoriza;

        return $this;
    }



    public function getIdActivoFijo(): ?IcActivosFijos
    {
        return $this->id_activo_fijo;
    }

    public function setIdActivoFijo(?IcActivosFijos $id_activo_fijo): self
    {
        $this->id_activo_fijo = $id_activo_fijo;
        return $this;
    }


    public function getFechaAutorizacion(): ?\DateTimeInterface
    {
        return $this->fecha_autorizacion;
    }

    public function setFechaAutorizacion(\DateTimeInterface $fecha_autorizacion): self
    {
        $this->fecha_autorizacion = $fecha_autorizacion;

        return $this;
    }

    public function getFechaSolicitud(): ?\DateTimeInterface
    {
        return $this->fecha_solicitud;
    }

    public function setFechaSolicitud(\DateTimeInterface $fecha): self
    {
        $this->fecha_solicitud = $fecha;

        return $this;
    }

    public function getFechaSalida(): ?\DateTimeInterface
    {
        return $this->fecha_salida;
    }

    public function setFechaSalida(\DateTimeInterface $fecha): self
    {
        $this->fecha_salida = $fecha;

        return $this;
    }


    public function getFechaEntrada(): ?\DateTimeInterface
    {
        return $this->fecha_entrada;
    }

    public function setFechaEntrada(\DateTimeInterface $fecha_entrada): self
    {
        $this->fecha_entrada = $fecha_entrada;

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

    public function getCodigoAutorizacion(): ?string
    {
        return $this->codigo_autorizacion;
    }

    public function setCodigoAutorizacion(string $codigo_autorizacion): self
    {
        $this->codigo_autorizacion = $codigo_autorizacion;

        return $this;
    }

    public function getNotas(): ?string
    {
        return $this->notas;
    }

    public function setNotas(?string $notas): self
    {
        $this->notas = $notas;

        return $this;
    }
}
