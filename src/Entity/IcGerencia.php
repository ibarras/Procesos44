<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcGerencia
 *
 * @ORM\Table(name="ic_gerencia", indexes={@ORM\Index(name="IDX_DC5FC2FB73B102B2", columns={"id_direccion"})})
 * @ORM\Entity
 */
class IcGerencia
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_gerencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_gerencia_id_gerencia_seq", allocationSize=1, initialValue=1)
     */
    private $idGerencia;

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
     * @var \IcDireccion
     *
     * @ORM\ManyToOne(targetEntity="IcDireccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_direccion", referencedColumnName="id_direccion")
     * })
     */
    private $idDireccion;

    public function getIdGerencia(): ?int
    {
        return $this->idGerencia;
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

    public function getIdDireccion(): ?IcDireccion
    {
        return $this->idDireccion;
    }

    public function setIdDireccion(?IcDireccion $idDireccion): self
    {
        $this->idDireccion = $idDireccion;

        return $this;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

}
