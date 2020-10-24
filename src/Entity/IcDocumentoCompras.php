<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcDocumentoCompras
 *
 * @ORM\Table(name="ic_documento_compras", indexes={@ORM\Index(name="IDX_5823D21DE80F48C7", columns={"id_compras"})})
 * @ORM\Entity
 */
class IcDocumentoCompras
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_documento_compras", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_documento_compras_id_documento_compras_seq", allocationSize=1, initialValue=1)
     */
    private $idDocumentoCompras;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

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

    public function getIdDocumentoCompras(): ?int
    {
        return $this->idDocumentoCompras;
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


}
