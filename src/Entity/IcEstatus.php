<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcEstatus
 *
 * @ORM\Table(name="ic_estatus")
 * @ORM\Entity
 */
class IcEstatus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_estatus", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_estatus_id_estatus_seq", allocationSize=1, initialValue=1)
     */
    private $idEstatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    public function getIdEstatus(): ?int
    {
        return $this->idEstatus;
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


}
