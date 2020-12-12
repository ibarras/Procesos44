<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcCuentaContable
 *
 * @ORM\Table(name="ic_cuenta_contable", indexes={@ORM\Index(name="IDX_D75D57057577DBC", columns={"id_centro_costo"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\IcCuentaContableRepository")
 */
class IcCuentaContable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_cuenta_contable_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var \IcCentroCosto
     *
     * @ORM\ManyToOne(targetEntity="IcCentroCosto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_costo", referencedColumnName="id")
     * })
     */
    private $idCentroCosto;

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

    public function getIdCentroCosto(): ?IcCentroCosto
    {
        return $this->idCentroCosto;
    }

    public function setIdCentroCosto(?IcCentroCosto $idCentroCosto): self
    {
        $this->idCentroCosto = $idCentroCosto;

        return $this;
    }


}
