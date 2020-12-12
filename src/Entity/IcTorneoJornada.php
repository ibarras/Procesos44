<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcTorneoJornada
 *
 * @ORM\Table(name="ic_torneo_jornada", indexes={@ORM\Index(name="IDX_C51B0E3E5ADCD613", columns={"id_torneo"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\IcTorneoJornadaRepository")
 */
class IcTorneoJornada
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_torneo_jornada_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @var \IcTorneo
     *
     * @ORM\ManyToOne(targetEntity="IcTorneo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_torneo", referencedColumnName="id")
     * })
     */
    private $idTorneo;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdTorneo(): ?IcTorneo
    {
        return $this->idTorneo;
    }

    public function setIdTorneo(?IcTorneo $idTorneo): self
    {
        $this->idTorneo = $idTorneo;

        return $this;
    }


}
