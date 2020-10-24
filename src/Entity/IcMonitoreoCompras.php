<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcMonitoreoCompras
 *
 * @ORM\Table(name="ic_monitoreo_compras", indexes={@ORM\Index(name="IDX_3CF97104E80F48C7", columns={"id_compras"}), @ORM\Index(name="IDX_3CF97104FCF8192D", columns={"id_usuario"})})
 * @ORM\Entity
 */
class IcMonitoreoCompras
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_monitoreo_compras", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_monitoreo_compras_id_monitoreo_compras_seq", allocationSize=1, initialValue=1)
     */
    private $idMonitoreoCompras;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_mensaje", type="date", nullable=true)
     */
    private $fechaMensaje;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensaje", type="text", nullable=true)
     */
    private $mensaje;

    /**
     * @var string|null
     *
     * @ORM\Column(name="archivo", type="string", nullable=true)
     */
    private $archivo;

    /**
     * @var \IcCompras
     *
     * @ORM\ManyToOne(targetEntity="IcCompras")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_compras", referencedColumnName="id_compras")
     * })
     */
    private $idCompras;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_perfil")
     * })
     */
    private $idUsuario;

    public function getIdMonitoreoCompras(): ?int
    {
        return $this->idMonitoreoCompras;
    }

    public function getFechaMensaje(): ?\DateTimeInterface
    {
        return $this->fechaMensaje;
    }

    public function setFechaMensaje(?\DateTimeInterface $fechaMensaje): self
    {
        $this->fechaMensaje = $fechaMensaje;

        return $this;
    }

    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }

    public function setMensaje(?string $mensaje): self
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    public function getArchivo(): ?string
    {
        return $this->archivo;
    }

    public function setArchivo(?string $archivo): self
    {
        $this->archivo = $archivo;

        return $this;
    }

    public function getIdCompras(): ?IcCompras
    {
        return $this->idCompras;
    }

    public function setIdCompras(?IcCompras $idCompras): self
    {
        $this->idCompras = $idCompras;

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
