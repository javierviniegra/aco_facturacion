<?php

namespace App\Entity;

use App\Repository\TipoDomicilioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoDomicilioRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class TipoDomicilio
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
     * @ORM\OneToMany(targetEntity=Domicilios::class, mappedBy="TipoDomicilio")
     */
    private $domicilios;

    public function __construct()
    {
        $this->domicilios = new ArrayCollection();
    }
    
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

    /**
     * @return Collection|Domicilios[]
     */
    public function getDomicilios(): Collection
    {
        return $this->domicilios;
    }

    public function addDomicilio(Domicilios $domicilio): self
    {
        if (!$this->domicilios->contains($domicilio)) {
            $this->domicilios[] = $domicilio;
            $domicilio->setTipoDomicilio($this);
        }

        return $this;
    }

    public function removeDomicilio(Domicilios $domicilio): self
    {
        if ($this->domicilios->removeElement($domicilio)) {
            // set the owning side to null (unless already changed)
            if ($domicilio->getTipoDomicilio() === $this) {
                $domicilio->setTipoDomicilio(null);
            }
        }

        return $this;
    }
}
