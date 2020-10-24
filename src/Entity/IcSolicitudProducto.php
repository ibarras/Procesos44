<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcSolicitudProducto
 *
 * @ORM\Table(name="ic_solicitud_producto", indexes={@ORM\Index(name="IDX_5F4637ECFCF8192D", columns={"id_usuario"}), @ORM\Index(name="IDX_5F4637EC57577DBC", columns={"id_centro_costo"}), @ORM\Index(name="IDX_5F4637EC2EFCD0C9", columns={"id_usuario_autoriza"})})
 * @ORM\Entity
 */
class IcSolicitudProducto
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_solicitud_producto_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=true)
     */
    private $fechaSolicitud;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="estatus", type="boolean", nullable=true)
     */
    private $estatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folio", type="string", length=10, nullable=true, options={"fixed"=true})
     */
    private $folio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrega", type="date", nullable=false)
     */
    private $fechaEntrega;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

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
     * @var \IcCentroCosto
     *
     * @ORM\ManyToOne(targetEntity="IcCentroCosto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_costo", referencedColumnName="id")
     * })
     */
    private $idCentroCosto;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_autoriza", referencedColumnName="id_perfil")
     * })
     */
    private $idUsuarioAutoriza;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaSolicitud(): ?\DateTimeInterface
    {
        return $this->fechaSolicitud;
    }

    public function setFechaSolicitud(?\DateTimeInterface $fechaSolicitud): self
    {
        $this->fechaSolicitud = $fechaSolicitud;

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

    public function getFolio(): ?string
    {
        return $this->folio;
    }

    public function setFolio(?string $folio): self
    {
        $this->folio = $folio;

        return $this;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fechaEntrega;
    }

    public function setFechaEntrega(\DateTimeInterface $fechaEntrega): self
    {
        $this->fechaEntrega = $fechaEntrega;

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

    public function getIdUsuario(): ?FosUser
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?FosUser $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

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

    public function getIdUsuarioAutoriza(): ?IcFosPerfil
    {
        return $this->idUsuarioAutoriza;
    }

    public function setIdUsuarioAutoriza(?IcFosPerfil $idUsuarioAutoriza): self
    {
        $this->idUsuarioAutoriza = $idUsuarioAutoriza;

        return $this;
    }


}
