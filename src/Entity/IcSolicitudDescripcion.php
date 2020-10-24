<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcSolicitudDescripcion
 *
 * @ORM\Table(name="ic_solicitud_descripcion", indexes={@ORM\Index(name="IDX_1F6EEEB416E7C0E7", columns={"id_solicitud"}), @ORM\Index(name="IDX_1F6EEEB42DE7A93B", columns={"id_cuenta_contable"})})
 * @ORM\Entity
 */
class IcSolicitudDescripcion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_solicitud_descripcion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=200, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_de_gasto", type="string", length=100, nullable=false)
     */
    private $tipoDeGasto;

    /**
     * @var string
     *
     * @ORM\Column(name="presupuesto", type="string", length=20, nullable=false)
     */
    private $presupuesto;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_real", type="string", length=20, nullable=false)
     */
    private $precioReal;

    /**
     * @var string
     *
     * @ORM\Column(name="variacion", type="string", length=20, nullable=false)
     */
    private $variacion;

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="string", length=20, nullable=false)
     */
    private $total;

    /**
     * @var string|null
     *
     * @ORM\Column(name="deposito", type="string", length=20, nullable=true)
     */
    private $deposito;

    /**
     * @var string|null
     *
     * @ORM\Column(name="saldo", type="string", length=20, nullable=true)
     */
    private $saldo;

    /**
     * @var bool
     *
     * @ORM\Column(name="retirar_saldo", type="boolean", nullable=false)
     */
    private $retirarSaldo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="es_activo", type="boolean", nullable=true)
     */
    private $esActivo = false;

    /**
     * @var \IcSolicitud
     *
     * @ORM\ManyToOne(targetEntity="IcSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud", referencedColumnName="id")
     * })
     */
    private $idSolicitud;

    /**
     * @var \IcCuentaContable
     *
     * @ORM\ManyToOne(targetEntity="IcCuentaContable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cuenta_contable", referencedColumnName="id")
     * })
     */
    private $idCuentaContable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getTipoDeGasto(): ?string
    {
        return $this->tipoDeGasto;
    }

    public function setTipoDeGasto(string $tipoDeGasto): self
    {
        $this->tipoDeGasto = $tipoDeGasto;

        return $this;
    }

    public function getPresupuesto(): ?string
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(string $presupuesto): self
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    public function getPrecioReal(): ?string
    {
        return $this->precioReal;
    }

    public function setPrecioReal(string $precioReal): self
    {
        $this->precioReal = $precioReal;

        return $this;
    }

    public function getVariacion(): ?string
    {
        return $this->variacion;
    }

    public function setVariacion(string $variacion): self
    {
        $this->variacion = $variacion;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getDeposito(): ?string
    {
        return $this->deposito;
    }

    public function setDeposito(?string $deposito): self
    {
        $this->deposito = $deposito;

        return $this;
    }

    public function getSaldo(): ?string
    {
        return $this->saldo;
    }

    public function setSaldo(?string $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function getRetirarSaldo(): ?bool
    {
        return $this->retirarSaldo;
    }

    public function setRetirarSaldo(bool $retirarSaldo): self
    {
        $this->retirarSaldo = $retirarSaldo;

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

    public function getEsActivo(): ?bool
    {
        return $this->esActivo;
    }

    public function setEsActivo(?bool $esActivo): self
    {
        $this->esActivo = $esActivo;

        return $this;
    }

    public function getIdSolicitud(): ?IcSolicitud
    {
        return $this->idSolicitud;
    }

    public function setIdSolicitud(?IcSolicitud $idSolicitud): self
    {
        $this->idSolicitud = $idSolicitud;

        return $this;
    }

    public function getIdCuentaContable(): ?IcCuentaContable
    {
        return $this->idCuentaContable;
    }

    public function setIdCuentaContable(?IcCuentaContable $idCuentaContable): self
    {
        $this->idCuentaContable = $idCuentaContable;

        return $this;
    }


}
