<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcActivosFijos
 *
 * @ORM\Table(name="ic_activos_fijos", indexes={@ORM\Index(name="IDX_51A270B59D2F320A", columns={"id_usuario_area"}), @ORM\Index(name="IDX_51A270B53E80D04", columns={"id_usuario_equipo"})})
 * @ORM\Entity
 */
class IcActivosFijos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_activos_fijos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=255, nullable=false)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=255, nullable=false)
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=255, nullable=false)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion", type="string", length=255, nullable=false)
     */
    private $ubicacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nota", type="text", nullable=true)
     */
    private $nota;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estatus", type="boolean", nullable=true)
     */
    private $estatus;




    public function getEstatus()
    {
        return $this->estatus;
    }


    public function setEstatus(bool $estatus): void
    {
        $this->estatus = $estatus;
    }

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_area", referencedColumnName="id")
     * })
     */
    private $idUsuarioArea;

    /**
     * @var \IcArea
     *
     * @ORM\ManyToOne(targetEntity="IcArea")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area", referencedColumnName="id_area")
     * })
     */
    private $idArea;


    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_equipo", referencedColumnName="id")
     * })
     */
    private $idUsuarioEquipo;


    /**
     * @var string
     *
     * @ORM\Column(name="codigo_barras", type="string", length=255, nullable=false)
     */
    private $codigoBarras;

    /**
     * @return string
     */
    public function getCodigoBarras(): string
    {
        return $this->codigoBarras;
    }

    /**
     * @param string $codigoBarras
     */
    public function setCodigoBarras(string $codigoBarras): void
    {
        $this->codigoBarras = $codigoBarras;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(string $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUbicacion(): ?string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(string $ubicacion): self
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    public function getNota(): ?string
    {
        return $this->nota;
    }

    public function setNota(?string $nota): self
    {
        $this->nota = $nota;

        return $this;
    }

    public function getIdUsuarioArea(): ?FosUser
    {
        return $this->idUsuarioArea;
    }

    public function setIdUsuarioArea(?FosUser $idUsuarioArea): self
    {
        $this->idUsuarioArea = $idUsuarioArea;

        return $this;
    }

    public function getIdUsuarioEquipo(): ?FosUser
    {
        return $this->idUsuarioEquipo;
    }

    public function setIdUsuarioEquipo(?FosUser $idUsuarioEquipo): self
    {
        $this->idUsuarioEquipo = $idUsuarioEquipo;

        return $this;
    }

    public function getIdArea(): ?IcArea
    {
        return $this->idArea;
    }

    /**
     * @param \IcArea $idArea
     */
    public function setIdArea(?IcArea $idArea): self
    {
        $this->idArea = $idArea;
    }

}
