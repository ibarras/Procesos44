<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcSubcategoriaUsuario
 *
 * @ORM\Table(name="ic_subcategoria_usuario", indexes={@ORM\Index(name="IDX_4B29738AF9BECC66", columns={"id_subcategoria"}), @ORM\Index(name="IDX_4B29738AD13D27E4", columns={"id_categoria_usuario"}), @ORM\Index(name="IDX_4B29738AC9C60A2A", columns={"id_fos_perfil"})})
 * @ORM\Entity
 */
class IcSubcategoriaUsuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_subcategoria_usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_subcategoria_usuario_id_subcategoria_usuario_seq", allocationSize=1, initialValue=1)
     */
    private $idSubcategoriaUsuario;

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
     * @var string|null
     *
     * @ORM\Column(name="slug_fos_perfil", type="string", length=255, nullable=true)
     */
    private $slugFosPerfil;

    /**
     * @var \IcSubcategoria
     *
     * @ORM\ManyToOne(targetEntity="IcSubcategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_subcategoria", referencedColumnName="id_subcategoria")
     * })
     */
    private $idSubcategoria;

    /**
     * @var \IcCategoriaUsuario
     *
     * @ORM\ManyToOne(targetEntity="IcCategoriaUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categoria_usuario", referencedColumnName="id_categoria_usuario")
     * })
     */
    private $idCategoriaUsuario;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fos_perfil", referencedColumnName="id_perfil")
     * })
     */
    private $idFosPerfil;

    public function getIdSubcategoriaUsuario(): ?int
    {
        return $this->idSubcategoriaUsuario;
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

    public function getSlugFosPerfil(): ?string
    {
        return $this->slugFosPerfil;
    }

    public function setSlugFosPerfil(?string $slugFosPerfil): self
    {
        $this->slugFosPerfil = $slugFosPerfil;

        return $this;
    }

    public function getIdSubcategoria(): ?IcSubcategoria
    {
        return $this->idSubcategoria;
    }

    public function setIdSubcategoria(?IcSubcategoria $idSubcategoria): self
    {
        $this->idSubcategoria = $idSubcategoria;

        return $this;
    }

    public function getIdCategoriaUsuario(): ?IcCategoriaUsuario
    {
        return $this->idCategoriaUsuario;
    }

    public function setIdCategoriaUsuario(?IcCategoriaUsuario $idCategoriaUsuario): self
    {
        $this->idCategoriaUsuario = $idCategoriaUsuario;

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
