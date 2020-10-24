<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcSolicitudPersonal
 *
 * @ORM\Table(name="ic_solicitud_personal", indexes={@ORM\Index(name="IDX_9775C7D1DFF04D7", columns={"id_centro_trabajo"}), @ORM\Index(name="IDX_9775C7D32B3CFB1", columns={"solicitado_por_usuario"}), @ORM\Index(name="IDX_9775C7D61F46733", columns={"id_puesto"})})
 * @ORM\Entity
 */
class IcSolicitudPersonal
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_solicitud_personal_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contratacion", type="string", length=255, nullable=true)
     */
    private $contratacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_contrato", type="string", length=255, nullable=false)
     */
    private $tipoContrato;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sexo_usuario", type="string", length=255, nullable=true)
     */
    private $sexoUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo", type="text", nullable=false)
     */
    private $motivo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_entrada", type="time", nullable=false)
     */
    private $horaEntrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_salida", type="time", nullable=false)
     */
    private $horaSalida;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="estatus", type="boolean", nullable=true)
     */
    private $estatus;

    /**
     * @var \IcCentroTrabajo
     *
     * @ORM\ManyToOne(targetEntity="IcCentroTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_trabajo", referencedColumnName="id_centro")
     * })
     */
    private $idCentroTrabajo;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="solicitado_por_usuario", referencedColumnName="id")
     * })
     */
    private $solicitadoPorUsuario;

    /**
     * @var \IcPuesto
     *
     * @ORM\ManyToOne(targetEntity="IcPuesto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_puesto", referencedColumnName="id_puesto")
     * })
     */
    private $idPuesto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContratacion(): ?string
    {
        return $this->contratacion;
    }

    public function setContratacion(?string $contratacion): self
    {
        $this->contratacion = $contratacion;

        return $this;
    }

    public function getTipoContrato(): ?string
    {
        return $this->tipoContrato;
    }

    public function setTipoContrato(string $tipoContrato): self
    {
        $this->tipoContrato = $tipoContrato;

        return $this;
    }

    public function getSexoUsuario(): ?string
    {
        return $this->sexoUsuario;
    }

    public function setSexoUsuario(?string $sexoUsuario): self
    {
        $this->sexoUsuario = $sexoUsuario;

        return $this;
    }

    public function getMotivo(): ?string
    {
        return $this->motivo;
    }

    public function setMotivo(string $motivo): self
    {
        $this->motivo = $motivo;

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

    public function getHoraEntrada(): ?\DateTimeInterface
    {
        return $this->horaEntrada;
    }

    public function setHoraEntrada(\DateTimeInterface $horaEntrada): self
    {
        $this->horaEntrada = $horaEntrada;

        return $this;
    }

    public function getHoraSalida(): ?\DateTimeInterface
    {
        return $this->horaSalida;
    }

    public function setHoraSalida(\DateTimeInterface $horaSalida): self
    {
        $this->horaSalida = $horaSalida;

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

    public function getIdCentroTrabajo(): ?IcCentroTrabajo
    {
        return $this->idCentroTrabajo;
    }

    public function setIdCentroTrabajo(?IcCentroTrabajo $idCentroTrabajo): self
    {
        $this->idCentroTrabajo = $idCentroTrabajo;

        return $this;
    }

    public function getSolicitadoPorUsuario(): ?FosUser
    {
        return $this->solicitadoPorUsuario;
    }

    public function setSolicitadoPorUsuario(?FosUser $solicitadoPorUsuario): self
    {
        $this->solicitadoPorUsuario = $solicitadoPorUsuario;

        return $this;
    }

    public function getIdPuesto(): ?IcPuesto
    {
        return $this->idPuesto;
    }

    public function setIdPuesto(?IcPuesto $idPuesto): self
    {
        $this->idPuesto = $idPuesto;

        return $this;
    }


}
