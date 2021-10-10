<?php

namespace App\Entity;

use App\Repository\RegisroClaveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegisroClaveRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class RegisroClave
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $clave;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_valid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $crated_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;


    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->crated_at = new \DateTime();
        $this->updated_at = new \DateTime();
        $this->is_valid = True;
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated_at = new \DateTime();
        $this->is_valid = False;
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

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(string $clave): self
    {
        $this->clave = $clave;

        return $this;
    }

    public function getIsValid(): ?bool
    {
        return $this->is_valid;
    }

    public function setIsValid(bool $is_valid): self
    {
        $this->is_valid = $is_valid;

        return $this;
    }

    public function getCratedAt(): ?\DateTime
    {
        return $this->crated_at;
    }

    public function setCratedAt(\DateTime $crated_at): self
    {
        $this->crated_at = $crated_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
