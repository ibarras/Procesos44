<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcCompras
 *
 * @ORM\Table(name="ic_compras", indexes={@ORM\Index(name="IDX_8C6E250E4D6F95FC", columns={"id_estatus_solicitud"}), @ORM\Index(name="IDX_8C6E250EBE02917F", columns={"id_solicitud_producto"})})
 * @ORM\Entity
 */
class IcCompras
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_compras", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_compras_id_compras_seq", allocationSize=1, initialValue=1)
     */
    private $idCompras;

    /**
     * @var \IcEstatusSolicitud
     *
     * @ORM\ManyToOne(targetEntity="IcEstatusSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estatus_solicitud", referencedColumnName="id_estatus_solicitud")
     * })
     */
    private $idEstatusSolicitud;

    /**
     * @var \IcSolicitudProducto
     *
     * @ORM\ManyToOne(targetEntity="IcSolicitudProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud_producto", referencedColumnName="id")
     * })
     */
    private $idSolicitudProducto;

    public function getIdCompras(): ?int
    {
        return $this->idCompras;
    }

    public function getIdEstatusSolicitud(): ?IcEstatusSolicitud
    {
        return $this->idEstatusSolicitud;
    }

    public function setIdEstatusSolicitud(?IcEstatusSolicitud $idEstatusSolicitud): self
    {
        $this->idEstatusSolicitud = $idEstatusSolicitud;

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
