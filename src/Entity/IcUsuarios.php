<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IcUsuarios
 *
 * @ORM\Table(name="ic_usuarios")
 * @ORM\Entity
 */
class IcUsuarios
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ic_usuarios_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }


}
