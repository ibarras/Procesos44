<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcCategoriaUsuario
 *
 * @ORM\Table(name="ic_categoria_usuario", indexes={@ORM\Index(name="IDX_9B03ACAFC9C60A2A", columns={"id_fos_perfil"})})
 * @ORM\Entity
 */
class IcCategoriaUsuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categoria_usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_categoria_usuario_id_categoria_usuario_seq", allocationSize=1, initialValue=1)
     */
    private $idCategoriaUsuario;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_categoria", type="integer", nullable=true)
     */
    private $idCategoria;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug_fos_perfil", type="string", length=255, nullable=true)
     */
    private $slugFosPerfil;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fos_perfil", referencedColumnName="id_perfil")
     * })
     */
    private $idFosPerfil;

    public function getIdCategoriaUsuario(): ?int
    {
        return $this->idCategoriaUsuario;
    }

    public function getIdCategoria(): ?int
    {
        return $this->idCategoria;
    }

    public function setIdCategoria(?int $idCategoria): self
    {
        $this->idCategoria = $idCategoria;

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

    public function getSlugFosPerfil(): ?string
    {
        return $this->slugFosPerfil;
    }

    public function setSlugFosPerfil(?string $slugFosPerfil): self
    {
        $this->slugFosPerfil = $slugFosPerfil;

        return $this;
    }

    public function getIdFosPerfil(): ?IcFosPerfil
    {
        return $this->idFosPerfil;
    }

    public function setIdFosPerfil(?IcFosPerfil $idFosPerfil): self
    {
        $this->idFosPerfil = $idFosPerfil;

        return $this;
    }


}
