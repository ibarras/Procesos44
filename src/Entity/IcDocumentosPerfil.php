<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcDocumentosPerfil
 *
 * @ORM\Table(name="ic_documentos_perfil", indexes={@ORM\Index(name="IDX_AF3ED577B052C3AA", columns={"id_perfil"})})
 * @ORM\Entity
 */
class IcDocumentosPerfil
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_documentos_perfil_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cv", type="string", length=255, nullable=true)
     */
    private $cv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="acta_nacimiento", type="string", length=255, nullable=true)
     */
    private $actaNacimiento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comprobante_domicilio", type="string", length=255, nullable=true)
     */
    private $comprobanteDomicilio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comprobante_estudios", type="string", length=255, nullable=true)
     */
    private $comprobanteEstudios;

    /**
     * @var string|null
     *
     * @ORM\Column(name="credencial_elector", type="string", length=255, nullable=true)
     */
    private $credencialElector;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cartas_recomendacion", type="string", length=255, nullable=true)
     */
    private $cartasRecomendacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fotografia", type="string", length=255, nullable=true)
     */
    private $fotografia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="carta_no_antecedentes_penales", type="string", length=255, nullable=true)
     */
    private $cartaNoAntecedentesPenales;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prueba_laboratorio", type="string", length=255, nullable=true)
     */
    private $pruebaLaboratorio;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_perfil", referencedColumnName="id_perfil")
     * })
     */
    private $idPerfil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getActaNacimiento(): ?string
    {
        return $this->actaNacimiento;
    }

    public function setActaNacimiento(?string $actaNacimiento): self
    {
        $this->actaNacimiento = $actaNacimiento;

        return $this;
    }

    public function getComprobanteDomicilio(): ?string
    {
        return $this->comprobanteDomicilio;
    }

    public function setComprobanteDomicilio(?string $comprobanteDomicilio): self
    {
        $this->comprobanteDomicilio = $comprobanteDomicilio;

        return $this;
    }

    public function getComprobanteEstudios(): ?string
    {
        return $this->comprobanteEstudios;
    }

    public function setComprobanteEstudios(?string $comprobanteEstudios): self
    {
        $this->comprobanteEstudios = $comprobanteEstudios;

        return $this;
    }

    public function getCredencialElector(): ?string
    {
        return $this->credencialElector;
    }

    public function setCredencialElector(?string $credencialElector): self
    {
        $this->credencialElector = $credencialElector;

        return $this;
    }

    public function getCartasRecomendacion(): ?string
    {
        return $this->cartasRecomendacion;
    }

    public function setCartasRecomendacion(?string $cartasRecomendacion): self
    {
        $this->cartasRecomendacion = $cartasRecomendacion;

        return $this;
    }

    public function getFotografia(): ?string
    {
        return $this->fotografia;
    }

    public function setFotografia(?string $fotografia): self
    {
        $this->fotografia = $fotografia;

        return $this;
    }

    public function getCartaNoAntecedentesPenales(): ?string
    {
        return $this->cartaNoAntecedentesPenales;
    }

    public function setCartaNoAntecedentesPenales(?string $cartaNoAntecedentesPenales): self
    {
        $this->cartaNoAntecedentesPenales = $cartaNoAntecedentesPenales;

        return $this;
    }

    public function getPruebaLaboratorio(): ?string
    {
        return $this->pruebaLaboratorio;
    }

    public function setPruebaLaboratorio(?string $pruebaLaboratorio): self
    {
        $this->pruebaLaboratorio = $pruebaLaboratorio;

        return $this;
    }

    public function getIdPerfil(): ?IcFosPerfil
    {
        return $this->idPerfil;
    }

    public function setIdPerfil(?IcFosPerfil $idPerfil): self
    {
        $this->idPerfil = $idPerfil;

        return $this;
    }


}
