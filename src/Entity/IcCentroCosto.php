<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcCentroCosto
 *
 * @ORM\Table(name="ic_centro_costo", indexes={@ORM\Index(name="IDX_329AD77C62CA3EBB", columns={"id_centro_organizativo"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\IcCentroCostoRepository")
 */
class IcCentroCosto
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_centro_costo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var \IcCentroOrganizativoDireccion
     *
     * @ORM\ManyToOne(targetEntity="IcCentroOrganizativoDireccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_organizativo", referencedColumnName="id")
     * })
     */
    private $idCentroOrganizativo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getIdCentroOrganizativo(): ?IcCentroOrganizativoDireccion
    {
        return $this->idCentroOrganizativo;
    }

    public function setIdCentroOrganizativo(?IcCentroOrganizativoDireccion $idCentroOrganizativo): self
    {
        $this->idCentroOrganizativo = $idCentroOrganizativo;

        return $this;
    }


}
