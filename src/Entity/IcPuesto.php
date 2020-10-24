<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcPuesto
 *
 * @ORM\Table(name="ic_puesto")
 * @ORM\Entity
 */
class IcPuesto
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_puesto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_puesto_id_puesto_seq", allocationSize=1, initialValue=1)
     */
    private $idPuesto;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;


    public function getIdPuesto(): ?int
    {
        return $this->idPuesto;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

}
