<?php

namespace App\Entity;

use App\Repository\AlmacenajesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlmacenajesRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Almacenajes
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
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $capacidad;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $alerta_maximo;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $alerta_minimo;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity=Combustibles::class)
     */
    private $combustible;


    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
        $this->is_active = True;
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated_at = new \DateTime();
    }

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getCapacidad(): ?float
    {
        return $this->capacidad;
    }

    public function setCapacidad(?float $capacidad): self
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    public function getAlertaMaximo(): ?float
    {
        return $this->alerta_maximo;
    }

    public function setAlertaMaximo(?float $alerta_maximo): self
    {
        $this->alerta_maximo = $alerta_maximo;

        return $this;
    }

    public function getAlertaMinimo(): ?float
    {
        return $this->alerta_minimo;
    }

    public function setAlertaMinimo(?float $alerta_minimo): self
    {
        $this->alerta_minimo = $alerta_minimo;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getCombustible(): ?Combustibles
    {
        return $this->combustible;
    }

    public function setCombustible(?Combustibles $combustible): self
    {
        $this->combustible = $combustible;

        return $this;
    }
}
