<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcCentroOrganizativoDireccion
 *
 * @ORM\Table(name="ic_centro_organizativo_direccion")
 * @ORM\Entity
 */
class IcCentroOrganizativoDireccion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_centro_organizativo_direccion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="id_direccion", type="integer", nullable=false)
     */
    private $idDireccion;

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

    public function getIdDireccion(): ?int
    {
        return $this->idDireccion;
    }

    public function setIdDireccion(int $idDireccion): self
    {
        $this->idDireccion = $idDireccion;

        return $this;
    }


}
