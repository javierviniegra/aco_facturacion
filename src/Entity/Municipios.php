<?php

namespace App\Entity;

use App\Repository\MunicipiosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MunicipiosRepository::class) 
 * @ORM\HasLifecycleCallbacks()
 */
class Municipios
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity=Estados::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado;

    public function __toString()
    {
        return $this->getNombre();
    }

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

    public function getEstado(): ?Estados
    {
        return $this->estado;
    }

    public function setEstado(?Estados $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
