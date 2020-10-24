<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Util\StringUtil;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IcArea
 *
 * @ORM\Table(name="ic_area", indexes={@ORM\Index(name="IDX_41B111D23E83D982", columns={"id_gerencia"})})
 * @ORM\Entity
 */
class IcArea
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_area", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_area_id_area_seq", allocationSize=1, initialValue=1)
     */
    private $idArea;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=false)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="correo", type="string", length=250, nullable=false)
     *
     * @Assert\Email(
     *     message = "El correo '{{ value }}' no es valid."
     * )
     */
    private $correo;

    /**
     *
     * @ORM\Column(name="telefono", type="string", length=15, nullable=false)
     * @Assert\Length(
     *      min = 10,
     *      max = 12,
     *      minMessage = "El numero de telefono debe ser de minimo {{ limit }} caracteres ",
     *      maxMessage = "El numero de telefomo maximo de otros paises debe ser de  {{ limit }} caracteres"
     * )
     *
     */
    private $telefono;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var \IcGerencia
     *
     * @ORM\ManyToOne(targetEntity="IcGerencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gerencia", referencedColumnName="id_gerencia")
     * })
     */
    private $idGerencia;

    public function getIdArea(): ?int
    {
        return $this->idArea;
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

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(?string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

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

    public function getIdGerencia(): ?IcGerencia
    {
        return $this->idGerencia;
    }

    public function setIdGerencia(?IcGerencia $idGerencia): self
    {
        $this->idGerencia = $idGerencia;

        return $this;
    }


}
