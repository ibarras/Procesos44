<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcMensajes
 *
 * @ORM\Table(name="ic_mensajes", indexes={@ORM\Index(name="IDX_DE956B6C174F5FAB", columns={"id_fos_destinatario"}), @ORM\Index(name="IDX_DE956B6CDDFF3020", columns={"id_fos_remitente"})})
 * @ORM\Entity
 */
class IcMensajes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_mensajes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_envio", type="date", nullable=true)
     */
    private $fechaEnvio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="archivo", type="string", length=255, nullable=true)
     */
    private $archivo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mensaje", type="text", nullable=true)
     */
    private $mensaje;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="leido", type="boolean", nullable=true)
     */
    private $leido;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_respuesta", type="date", nullable=true)
     */
    private $fechaRespuesta;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fos_destinatario", referencedColumnName="id_perfil")
     * })
     */
    private $idFosDestinatario;

    /**
     * @var \IcFosPerfil
     *
     * @ORM\ManyToOne(targetEntity="IcFosPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fos_remitente", referencedColumnName="id_perfil")
     * })
     */
    private $idFosRemitente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAsunto(): ?string
    {
        return $this->asunto;
    }

    public function setAsunto(string $asunto): self
    {
        $this->asunto = $asunto;

        return $this;
    }

    public function getFechaEnvio(): ?\DateTimeInterface
    {
        return $this->fechaEnvio;
    }

    public function setFechaEnvio(?\DateTimeInterface $fechaEnvio): self
    {
        $this->fechaEnvio = $fechaEnvio;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getArchivo(): ?string
    {
        return $this->archivo;
    }

    public function setArchivo(?string $archivo): self
    {
        $this->archivo = $archivo;

        return $this;
    }

    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }

    public function setMensaje(?string $mensaje): self
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    public function getLeido(): ?bool
    {
        return $this->leido;
    }

    public function setLeido(?bool $leido): self
    {
        $this->leido = $leido;

        return $this;
    }

    public function getFechaRespuesta(): ?\DateTimeInterface
    {
        return $this->fechaRespuesta;
    }

    public function setFechaRespuesta(?\DateTimeInterface $fechaRespuesta): self
    {
        $this->fechaRespuesta = $fechaRespuesta;

        return $this;
    }

    public function getIdFosDestinatario(): ?IcFosPerfil
    {
        return $this->idFosDestinatario;
    }

    public function setIdFosDestinatario(?IcFosPerfil $idFosDestinatario): self
    {
        $this->idFosDestinatario = $idFosDestinatario;

        return $this;
    }

    public function getIdFosRemitente(): ?IcFosPerfil
    {
        return $this->idFosRemitente;
    }

    public function setIdFosRemitente(?IcFosPerfil $idFosRemitente): self
    {
        $this->idFosRemitente = $idFosRemitente;

        return $this;
    }


}
