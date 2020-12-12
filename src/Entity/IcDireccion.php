<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcDireccion
 *
 * @ORM\Table(name="ic_direccion")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\IcDireccionRepository")
 */
class IcDireccion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_direccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_direccion_id_direccion_seq", allocationSize=1, initialValue=1)
     */
    private $idDireccion;

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

    public function getIdDireccion(): ?int
    {
        return $this->idDireccion;
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
