<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Helpers\IcUpload;
use App\Repository\IcPagoRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IcPagoRepository::class)
 */
class IcPago extends IcUpload
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_pago_id_seq", allocationSize=1, initialValue=1)
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $monto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comprobante;

    /**
     * @var \IcPagoProyectado
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="IcPagoProyectado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pago_proyectado", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPagoProyectado;

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

    public function getMonto(): ?string
    {
        return $this->monto;
    }

    public function setMonto(?string $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getComprobante(): ?string
    {
        return $this->comprobante;
    }

    public function setComprobante(?string $comprobante): self
    {
        $this->comprobante = $comprobante;

        return $this;
    }

    /**
     * @Assert\File(maxSize="2M", mimeTypes={"image/png", "image/jpeg", "image/jpg"})
     */
    private $IcComprobante;
    /**
     * Set IcComprobante
     * @param UploadedFile $file
     * @return IcComprobante
     */
    public function setIcComprobante(File $file=null)
    {
        $img = $this->setFile($file, 'comprobantes/');
        $this->comprobante = $img;

        return $this;
    }

    /**
     * Get file
     * @return file
     */
    public function getIcComprobante()
    {
        return $this->getFile();
    }

    public function getIdPagoProyectado(): ?IcPagoProyectado
    {
        return $this->idPagoProyectado;
    }

    public function setIdPagoProyectado(?IcPagoProyectado $idPagoProyectado): self
    {
        $this->idPagoProyectado = $idPagoProyectado;

        return $this;
    }
}
