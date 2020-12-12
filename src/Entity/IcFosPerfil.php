<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcFosPerfil
 *
 * @ORM\Table(name="ic_fos_perfil", indexes={@ORM\Index(name="IDX_BD5EE3A55CB4216A", columns={"id_area"}), @ORM\Index(name="IDX_BD5EE3A542B686", columns={"id_centro"}), @ORM\Index(name="IDX_BD5EE3A573B102B2", columns={"id_direccion"}), @ORM\Index(name="IDX_BD5EE3A56D6D134", columns={"id_fos"}), @ORM\Index(name="IDX_BD5EE3A53E83D982", columns={"id_gerencia"}), @ORM\Index(name="IDX_BD5EE3A561F46733", columns={"id_puesto"})})
 * @ORM\Entity
  * @ORM\Entity(repositoryClass="App\Repository\IcFosPerfilRepository")
 */
class IcFosPerfil
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_perfil", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_fos_perfil_id_perfil_seq", allocationSize=1, initialValue=1)
     */
    private $idPerfil;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="apellido", type="string", length=250, nullable=true)
     */
    private $apellido;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telefono", type="string", length=15, nullable=true)
     */
    private $telefono;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firma", type="string", length=250, nullable=true)
     */
    private $firma;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=true)
     */
    private $fechaIngreso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="periocidad_pago", type="string", length=255, nullable=true)
     */
    private $periocidadPago;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lugar_nacimiento", type="string", length=255, nullable=true)
     */
    private $lugarNacimiento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="edad", type="string", length=255, nullable=true)
     */
    private $edad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sexo", type="string", length=255, nullable=true)
     */
    private $sexo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rfc", type="string", length=255, nullable=true)
     */
    private $rfc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="curp", type="string", length=255, nullable=true)
     */
    private $curp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nss", type="string", length=255, nullable=true)
     */
    private $nss;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado_civil", type="string", length=255, nullable=true)
     */
    private $estadoCivil;

    /**
     * @var string|null
     *
     * @ORM\Column(name="profesion", type="string", length=255, nullable=true)
     */
    private $profesion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="banco", type="string", length=255, nullable=true)
     */
    private $banco;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cuenta", type="string", length=255, nullable=true)
     */
    private $cuenta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="clabe_interbancaria", type="string", length=255, nullable=true)
     */
    private $clabeInterbancaria;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nomina", type="string", length=255, nullable=true)
     */
    private $nomina;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensual", type="string", length=255, nullable=true)
     */
    private $mensual;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tipo_pago", type="string", length=255, nullable=true)
     */
    private $tipoPago;

    /**
     * @var string|null
     *
     * @ORM\Column(name="diario", type="string", length=255, nullable=true)
     */
    private $diario;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="estatus", type="boolean", nullable=true)
     */
    private $estatus;

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
     * @var \IcCentroTrabajo
     *
     * @ORM\ManyToOne(targetEntity="IcCentroTrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro", referencedColumnName="id_centro")
     * })
     */
    private $idCentro;

    /**
     * @var \IcDireccion
     *
     * @ORM\ManyToOne(targetEntity="IcDireccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_direccion", referencedColumnName="id_direccion")
     * })
     */
    private $idDireccion;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fos", referencedColumnName="id")
     * })
     */
    private $idFos;

    /**
     * @var \IcGerencia
     *
     * @ORM\ManyToOne(targetEntity="IcGerencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_gerencia", referencedColumnName="id_gerencia")
     * })
     */
    private $idGerencia;

    /**
     * @var \IcPuesto
     *
     * @ORM\ManyToOne(targetEntity="IcPuesto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_puesto", referencedColumnName="id_puesto")
     * })
     */
    private $idPuesto;

    public function getIdPerfil(): ?int
    {
        return $this->idPerfil;
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

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): self
    {
        $this->apellido = $apellido;

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

    public function getFirma(): ?string
    {
        return $this->firma;
    }

    public function setFirma(?string $firma): self
    {
        $this->firma = $firma;

        return $this;
    }

    public function getFechaIngreso(): ?\DateTimeInterface
    {
        return $this->fechaIngreso;
    }

    public function setFechaIngreso(?\DateTimeInterface $fechaIngreso): self
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    public function getPeriocidadPago(): ?string
    {
        return $this->periocidadPago;
    }

    public function setPeriocidadPago(?string $periocidadPago): self
    {
        $this->periocidadPago = $periocidadPago;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getLugarNacimiento(): ?string
    {
        return $this->lugarNacimiento;
    }

    public function setLugarNacimiento(?string $lugarNacimiento): self
    {
        $this->lugarNacimiento = $lugarNacimiento;

        return $this;
    }

    public function getEdad(): ?string
    {
        return $this->edad;
    }

    public function setEdad(?string $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getRfc(): ?string
    {
        return $this->rfc;
    }

    public function setRfc(?string $rfc): self
    {
        $this->rfc = $rfc;

        return $this;
    }

    public function getCurp(): ?string
    {
        return $this->curp;
    }

    public function setCurp(?string $curp): self
    {
        $this->curp = $curp;

        return $this;
    }

    public function getNss(): ?string
    {
        return $this->nss;
    }

    public function setNss(?string $nss): self
    {
        $this->nss = $nss;

        return $this;
    }

    public function getEstadoCivil(): ?string
    {
        return $this->estadoCivil;
    }

    public function setEstadoCivil(?string $estadoCivil): self
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    public function getProfesion(): ?string
    {
        return $this->profesion;
    }

    public function setProfesion(?string $profesion): self
    {
        $this->profesion = $profesion;

        return $this;
    }

    public function getBanco(): ?string
    {
        return $this->banco;
    }

    public function setBanco(?string $banco): self
    {
        $this->banco = $banco;

        return $this;
    }

    public function getCuenta(): ?string
    {
        return $this->cuenta;
    }

    public function setCuenta(?string $cuenta): self
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    public function getClabeInterbancaria(): ?string
    {
        return $this->clabeInterbancaria;
    }

    public function setClabeInterbancaria(?string $clabeInterbancaria): self
    {
        $this->clabeInterbancaria = $clabeInterbancaria;

        return $this;
    }

    public function getNomina(): ?string
    {
        return $this->nomina;
    }

    public function setNomina(?string $nomina): self
    {
        $this->nomina = $nomina;

        return $this;
    }

    public function getMensual(): ?string
    {
        return $this->mensual;
    }

    public function setMensual(?string $mensual): self
    {
        $this->mensual = $mensual;

        return $this;
    }

    public function getTipoPago(): ?string
    {
        return $this->tipoPago;
    }

    public function setTipoPago(?string $tipoPago): self
    {
        $this->tipoPago = $tipoPago;

        return $this;
    }

    public function getDiario(): ?string
    {
        return $this->diario;
    }

    public function setDiario(?string $diario): self
    {
        $this->diario = $diario;

        return $this;
    }

    public function getEstatus(): ?bool
    {
        return $this->estatus;
    }

    public function setEstatus(?bool $estatus): self
    {
        $this->estatus = $estatus;

        return $this;
    }

    public function getIdArea(): ?IcArea
    {
        return $this->idArea;
    }

    public function setIdArea(?IcArea $idArea): self
    {
        $this->idArea = $idArea;

        return $this;
    }

    public function getIdCentro(): ?IcCentroTrabajo
    {
        return $this->idCentro;
    }

    public function setIdCentro(?IcCentroTrabajo $idCentro): self
    {
        $this->idCentro = $idCentro;

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

    public function getIdFos(): ?FosUser
    {
        return $this->idFos;
    }

    public function setIdFos(?FosUser $idFos): self
    {
        $this->idFos = $idFos;

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

    public function getIdPuesto(): ?IcPuesto
    {
        return $this->idPuesto;
    }

    public function setIdPuesto(?IcPuesto $idPuesto): self
    {
        $this->idPuesto = $idPuesto;

        return $this;
    }

    public function __toString()
    {
        return $this->getNombre();
    }


}
