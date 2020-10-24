<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcSubcategoria
 *
 * @ORM\Table(name="ic_subcategoria", indexes={@ORM\Index(name="IDX_9C7366A6CE25AE0A", columns={"id_categoria"})})
 * @ORM\Entity
 */
class IcSubcategoria
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_subcategoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_subcategoria_id_subcategoria_seq", allocationSize=1, initialValue=1)
     */
    private $idSubcategoria;

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

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug_categoria", type="string", length=255, nullable=true)
     */
    private $slugCategoria;

    /**
     * @var \IcCategoria
     *
     * @ORM\ManyToOne(targetEntity="IcCategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categoria", referencedColumnName="id_categoria")
     * })
     */
    private $idCategoria;

    public function getIdSubcategoria(): ?int
    {
        return $this->idSubcategoria;
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

    public function getSlugCategoria(): ?string
    {
        return $this->slugCategoria;
    }

    public function setSlugCategoria(?string $slugCategoria): self
    {
        $this->slugCategoria = $slugCategoria;

        return $this;
    }

    public function getIdCategoria(): ?IcCategoria
    {
        return $this->idCategoria;
    }

    public function setIdCategoria(?IcCategoria $idCategoria): self
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }


}
