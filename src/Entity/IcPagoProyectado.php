<?php

namespace App\Entity;

use App\Repository\IcPagoProyectadoRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IcPagoProyectadoRepository::class)
 */
class IcPagoProyectado
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_pago_proyectado_id_seq", allocationSize=1, initialValue=1)
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(name="fecha_pago_proyectado", type="date", nullable=true)
     */
    private $fechaPagoProyectado;

    /**
     * @ORM\Column(name="fecha_limite_pago", type="date", nullable=true)
     */
    private $fechaLimitePago;

    /**
     * @ORM\Column(name="monto", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $monto;

    /**
     * @var \IcPatrocinador
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="IcPatrocinador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patrocinador", referencedColumnName="id")
     * })
     */
    private $idPatrocinador;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaPagoProyectado(): ?\DateTimeInterface
    {
        return $this->fechaPagoProyectado;
    }

    public function setFechaPagoProyectado(\DateTimeInterface $fechaPagoProyectado): self
    {
        $this->fechaPagoProyectado = $fechaPagoProyectado;

        return $this;
    }

    public function getFechaLimitePago(): ?\DateTimeInterface
    {
        return $this->fechaLimitePago;
    }

    public function setFechaLimitePago(?\DateTimeInterface $fechaLimitePago): self
    {
        $this->fechaLimitePago = $fechaLimitePago;

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

    public function getIdPatrocinador(): ?IcPatrocinador
    {
        return $this->idPatrocinador;
    }

    public function setIdPatrocinador(?IcPatrocinador $idPatrocinador): self
    {
        $this->idPatrocinador = $idPatrocinador;

        return $this;
    }
}
