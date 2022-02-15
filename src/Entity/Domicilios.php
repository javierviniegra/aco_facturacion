<?php

namespace App\Entity;

use App\Repository\DomiciliosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DomiciliosRepository::class)
 */
class Domicilios
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
     * @ORM\Column(type="string", length=255)
     */
    private $calle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numExterior;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numInterior;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $colonia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codigoPostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poblacion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $municipio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $estado;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pais;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nacionalidad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefono1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefono2;

    /**
     * @ORM\Column(type="string", length=511, nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity=Clientes::class, inversedBy="domicilio")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity=TipoDomicilio::class, inversedBy="domicilios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TipoDomicilio;

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

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(string $calle): self
    {
        $this->calle = $calle;

        return $this;
    }

    public function getNumExterior(): ?string
    {
        return $this->numExterior;
    }

    public function setNumExterior(string $numExterior): self
    {
        $this->numExterior = $numExterior;

        return $this;
    }

    public function getNumInterior(): ?string
    {
        return $this->numInterior;
    }

    public function setNumInterior(?string $numInterior): self
    {
        $this->numInterior = $numInterior;

        return $this;
    }

    public function getColonia(): ?string
    {
        return $this->colonia;
    }

    public function setColonia(string $colonia): self
    {
        $this->colonia = $colonia;

        return $this;
    }

    public function getCodigoPostal(): ?string
    {
        return $this->codigoPostal;
    }

    public function setCodigoPostal(string $codigoPostal): self
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    public function getPoblacion(): ?string
    {
        return $this->poblacion;
    }

    public function setPoblacion(?string $poblacion): self
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    public function getMunicipio(): ?string
    {
        return $this->municipio;
    }

    public function setMunicipio(?string $municipio): self
    {
        $this->municipio = $municipio;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(?string $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

    public function getNacionalidad(): ?string
    {
        return $this->nacionalidad;
    }

    public function setNacionalidad(?string $nacionalidad): self
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    public function getTelefono1(): ?string
    {
        return $this->telefono1;
    }

    public function setTelefono1(string $telefono1): self
    {
        $this->telefono1 = $telefono1;

        return $this;
    }

    public function getTelefono2(): ?string
    {
        return $this->telefono2;
    }

    public function setTelefono2(?string $telefono2): self
    {
        $this->telefono2 = $telefono2;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getCliente(): ?Clientes
    {
        return $this->cliente;
    }

    public function setCliente(?Clientes $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getTipoDomicilio(): ?TipoDomicilio
    {
        return $this->TipoDomicilio;
    }

    public function setTipoDomicilio(?TipoDomicilio $TipoDomicilio): self
    {
        $this->TipoDomicilio = $TipoDomicilio;

        return $this;
    }
}
