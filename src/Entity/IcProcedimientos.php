<?php

namespace App\Entity;

use App\Helpers\IcUpload;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IcProcedimientos
 *
 * @ORM\Table(name="ic_procedimientos", indexes={@ORM\Index(name="IDX_7CD67DAAB44855AA", columns={"id_procesos"})})
 * @ORM\Entity
 */
class IcProcedimientos extends IcUpload
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_procedimientos_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var \IcProcesos
     *
     * @ORM\ManyToOne(targetEntity="IcProcesos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_procesos", referencedColumnName="id")
     * })
     */
    private $idProcesos;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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

    public function getIdProcesos(): ?IcProcesos
    {
        return $this->idProcesos;
    }

    public function setIdProcesos(?IcProcesos $idProcesos): self
    {
        $this->idProcesos = $idProcesos;

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
