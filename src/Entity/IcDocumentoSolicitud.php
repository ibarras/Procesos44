<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcDocumentoSolicitud
 *
 * @ORM\Table(name="ic_documento_solicitud")
 * @ORM\Entity
 */
class IcDocumentoSolicitud
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_documento_solicitud_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="archivo", type="string", length=255, nullable=true)
     */
    private $archivo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comentario", type="string", length=255, nullable=true)
     */
    private $comentario;

    /**
     * @var string|null
     *
     * @ORM\Column(name="folio", type="string", length=255, nullable=true)
     */
    private $folio;

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

    public function getArchivo(): ?string
    {
        return $this->archivo;
    }

    public function setArchivo(?string $archivo): self
    {
        $this->archivo = $archivo;

        return $this;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(?string $comentario): self
    {
        $this->comentario = $comentario;

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


}
