<?php

namespace App\Entity;

use App\Repository\HistoricosCombustiblesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoricosCombustiblesRepository::class)
 */
class HistoricosCombustibles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Combustibles::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $combustible;

    /**
     * @ORM\Column(type="float")
     */
    private $valor;

    /**
     * @ORM\ManyToOne(targetEntity=SonataUserUSer::class)
     */
    private $usuario;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getUsuario(): ?SonataUserUSer
    {
        return $this->usuario;
    }

    public function setUsuario(?SonataUserUSer $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
