<?php

namespace App\Entity;

use App\Repository\IcPatrocinadorRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Helpers\IcUpload;

/**
 * @ORM\Entity(repositoryClass=IcPatrocinadorRepository::class)
 */
class IcPatrocinador extends IcUpload
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_patrocinador_id_seq", allocationSize=1, initialValue=1)
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(name="nombre_comercial", type="string", length=255, nullable=true)
     */
    private $nombreComercial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rfc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $correo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;


    /**
     * @var \FosUser
     * @Assert\NotNull
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id", nullable=false)
     * })
     */
    private $idUsuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNombreComercial(): ?string
    {
        return $this->nombreComercial;
    }

    public function setNombreComercial(?string $nombreComercial): self
    {
        $this->nombreComercial = $nombreComercial;

        return $this;
    }

    public function getRfc(): ?string
    {
        return $this->rfc;
    }

    public function setRfc(?string $rfc): self
    {
        $this->rfc = $rfc;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(?string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

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

    /**
     * @Assert\File(maxSize="2M", mimeTypes={"image/png", "image/jpeg", "image/jpg"})
     */
    private $IcLogo;
    /**
     * Set IcLogo
     * @param UploadedFile $file
     * @return IcLogo
     */
    public function setIcLogo(File $file=null)
    {
        $img = $this->setFile($file, 'logos/');
        $this->logo = $img;

        return $this;
    }

    /**
     * Get file
     * @return file
     */
    public function getIcLogo()
    {
        return $this->getFile();
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->nombreComercial;
    }
}
