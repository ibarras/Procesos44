<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcCategoria
 *
 * @ORM\Table(name="ic_categoria")
 * @ORM\Entity
 */
class IcCategoria
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_categoria_id_categoria_seq", allocationSize=1, initialValue=1)
     */
    private $idCategoria;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    public function getIdCategoria(): ?int
    {
        return $this->idCategoria;
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
