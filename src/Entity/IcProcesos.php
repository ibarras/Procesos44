<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Helpers\IcUpload;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IcProcesos
 *
 * @ORM\Table(name="ic_procesos", indexes={@ORM\Index(name="IDX_56944ED37295801F", columns={"id_macroprocesos"})})
 * @ORM\Entity
 */
class IcProcesos extends IcUpload
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_procesos_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var \IcMacroprocesos
     *
     * @ORM\ManyToOne(targetEntity="IcMacroprocesos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_macroprocesos", referencedColumnName="id")
     * })
     */
    private $idMacroprocesos;

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

    public function getIdMacroprocesos(): ?IcMacroprocesos
    {
        return $this->idMacroprocesos;
    }

    public function setIdMacroprocesos(?IcMacroprocesos $idMacroprocesos): self
    {
        $this->idMacroprocesos = $idMacroprocesos;

        return $this;
    }

    /**
     * @Assert\File(maxSize="2M", mimeTypes={"image/png", "image/jpeg", "image/pjpeg"})
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
        $img = $this->setFile($file, 'procesos/');
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
