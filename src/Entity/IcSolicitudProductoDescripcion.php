<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcSolicitudProductoDescripcion
 *
 * @ORM\Table(name="ic_solicitud_producto_descripcion", indexes={@ORM\Index(name="IDX_8C167448BE02917F", columns={"id_solicitud_producto"})})
 * @ORM\Entity
 */
class IcSolicitudProductoDescripcion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_solicitud_producto_descripcion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sku", type="string", length=20, nullable=true, options={"fixed"=true})
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="string", length=5, nullable=false, options={"fixed"=true})
     */
    private $cantidad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var string|null
     *
     * @ORM\Column(name="documento", type="string", length=100, nullable=true)
     */
    private $documento;

    /**
     * @var \IcSolicitudProducto
     *
     * @ORM\ManyToOne(targetEntity="IcSolicitudProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_producto", referencedColumnName="id")
     * })
     */
    private $idSolicitudProducto;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getCantidad(): ?string
    {
        return $this->cantidad;
    }

    public function setCantidad(string $cantidad): self
    {
        $this->cantidad = $cantidad;

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

    public function getIdSolicitudProducto(): ?IcSolicitudProducto
    {
        return $this->idSolicitudProducto;
    }

    public function setIdSolicitudProducto(?IcSolicitudProducto $idSolicitudProducto): self
    {
        $this->idSolicitudProducto = $idSolicitudProducto;

        return $this;
    }


}
