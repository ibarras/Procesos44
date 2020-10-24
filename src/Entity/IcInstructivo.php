<?php

namespace App\Entity;

use App\Helpers\IcUpload;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IcInstructivo
 *
 * @ORM\Table(name="ic_instructivo", indexes={@ORM\Index(name="IDX_F2DCB377AE664387", columns={"id_instruccion"}), @ORM\Index(name="IDX_F2DCB37716E7C0E7", columns={"id_solicitud"})})
 * @ORM\Entity
 */
class IcInstructivo extends IcUpload

{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_instructivo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \IcInstruccionTrabajo
     *
     * @ORM\ManyToOne(targetEntity="IcInstruccionTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_instruccion", referencedColumnName="id")
     * })
     */
    private $idInstruccion;

    /**
     * @var \IcTipoSolicitud
     *
     * @ORM\ManyToOne(targetEntity="IcTipoSolicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_solicitud", referencedColumnName="id")
     * })
     */
    private $idSolicitud;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
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

    public function getIdInstruccion(): ?IcInstruccionTrabajo
    {
        return $this->idInstruccion;
    }

    public function setIdInstruccion(?IcInstruccionTrabajo $idInstruccion): self
    {
        $this->idInstruccion = $idInstruccion;

        return $this;
    }

    public function getIdSolicitud(): ?IcTipoSolicitud
    {
        return $this->idSolicitud;
    }

    public function setIdSolicitud(?IcTipoSolicitud $idSolicitud): self
    {
        $this->idSolicitud = $idSolicitud;

        return $this;
    }

    /**
     * @Assert\File(maxSize="1M", mimeTypes={"image/png", "image/jpeg", "image/pjpeg"})
     */
    private $IcImagen;
    /**
     * Set IcImagen
     * @param UploadedFile $file
     * @return IcEquipo
     *
     */
    public function setIcImagen(File $file = null)
    {
        $img = $this->setFile($file, 'procesos/procedimientos/');
        $this->imagen = $img;

        return $this;

    }

    /**
     * Get file
     * @return file
     */
    public function getIcImagen()
    {
        return $this->getFile();
    }

    public function __toString()
    {
        return $this->getTitle();
    }


}
