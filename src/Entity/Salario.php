<?php

namespace App\Entity;

use App\Repository\SalarioRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=SalarioRepository::class)
 */
class Salario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $monto;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity=SonataUserUser::class, inversedBy="sueldos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sonataUserUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonto(): ?int
    {
        return $this->monto;
    }

    public function setMonto(int $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getFecha(): ?\DateTime
    {
        return $this->fecha;
    }

    public function setFecha(\DateTime $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getSonataUserUser(): ?SonataUserUser
    {
        return $this->sonataUserUser;
    }

    public function setSonataUserUser(?SonataUserUser $sonataUserUser): self
    {
        $this->sonataUserUser = $sonataUserUser;

        return $this;
    }
}
