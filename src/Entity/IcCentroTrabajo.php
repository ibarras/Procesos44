<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IcCentroTrabajo
 *
 * @ORM\Table(name="ic_centro_trabajo")
 * @ORM\Entity
 */
class IcCentroTrabajo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_centro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_centro_trabajo_id_centro_seq", allocationSize=1, initialValue=1)
     */
    private $idCentro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="direccion", type="string", length=250, nullable=true)
     */
    private $direccion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="correo", type="string", length=250, nullable=false)
     * @Assert\Email(
     *     message = "El correo '{{ value }}' no es valid."
     * )
     */
    private $correo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telefono", type="string", length=15, nullable=false)
     * @Assert\Length(
     *      min = 10,
     *      max = 12,
     *      minMessage = "El numero de telefono debe ser de minimo {{ limit }} caracteres ",
     *      maxMessage = "El numero de telefomo maximo de otros paises debe ser de  {{ limit }} caracteres"
     * )
     */
    private $telefono;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    public function getIdCentro(): ?int
    {
        return $this->idCentro;
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

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

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

    public function __toString()
    {
        return $this->getNombre();
    }
}
