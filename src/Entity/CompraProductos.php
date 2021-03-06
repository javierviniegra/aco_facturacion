<?php

namespace App\Entity;

use App\Repository\CompraProductosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompraProductosRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class CompraProductos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Productos::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $producto;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $litros;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $precioLitro;

    /**
     * @ORM\Column(type="boolean")
     */
    private $requiereIeps;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $factorIeps;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalIeps;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $iva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $subtotal;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Compras::class, inversedBy="productos")
     */
    private $compras;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $recibido;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaRecepcion;

    /**
     * @ORM\ManyToOne(targetEntity=Almacenajes::class)
     */
    private $almacenaje;

    /**
     * @ORM\ManyToOne(targetEntity=SonataUserUser::class)
     */
    private $quienRecibe;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $temperatura;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $presion_absoluta;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
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
        return $this->getProducto()->getNombre();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducto(): ?Productos
    {
        return $this->producto;
    }

    public function setProducto(?Productos $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    public function getLitros(): ?float
    {
        return $this->litros;
    }

    public function setLitros(?float $litros): self
    {
        $this->litros = $litros;

        return $this;
    }

    public function getPrecioLitro(): ?float
    {
        return $this->precioLitro;
    }

    public function setPrecioLitro(?float $precioLitro): self
    {
        $this->precioLitro = $precioLitro;

        return $this;
    }

    public function getRequiereIeps(): ?bool
    {
        return $this->requiereIeps;
    }

    public function setRequiereIeps(bool $requiereIeps): self
    {
        $this->requiereIeps = $requiereIeps;

        return $this;
    }

    public function getFactorIeps(): ?float
    {
        return $this->factorIeps;
    }

    public function setFactorIeps(?float $factorIeps): self
    {
        $this->factorIeps = $factorIeps;

        return $this;
    }

    public function getTotalIeps(): ?float
    {
        return $this->totalIeps;
    }

    public function setTotalIeps(?float $totalIeps): self
    {
        $this->totalIeps = $totalIeps;

        return $this;
    }

    public function getIva(): ?float
    {
        return $this->iva;
    }

    public function setIva(?float $iva): self
    {
        $this->iva = $iva;

        return $this;
    }

    public function getSubtotal(): ?float
    {
        return $this->subtotal;
    }

    public function setSubtotal(?float $subtotal): self
    {
        $this->subtotal = $subtotal;

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

    public function getCompras(): ?Compras
    {
        return $this->compras;
    }

    public function setCompras(?Compras $compras): self
    {
        $this->compras = $compras;

        return $this;
    }

    public function getRecibido(): ?bool
    {
        return $this->recibido;
    }

    public function setRecibido(?bool $recibido): self
    {
        $this->recibido = $recibido;

        return $this;
    }

    public function getFechaRecepcion(): ?\DateTimeInterface
    {
        return $this->fechaRecepcion;
    }

    public function setFechaRecepcion(?\DateTimeInterface $fechaRecepcion): self
    {
        $this->fechaRecepcion = $fechaRecepcion;

        return $this;
    }

    public function getAlmacenaje(): ?Almacenajes
    {
        return $this->almacenaje;
    }

    public function setAlmacenaje(?Almacenajes $almacenaje): self
    {
        $this->almacenaje = $almacenaje;

        return $this;
    }

    public function getQuienRecibe(): ?SonataUserUser
    {
        return $this->quienRecibe;
    }

    public function setQuienRecibe(?SonataUserUser $quienRecibe): self
    {
        $this->quienRecibe = $quienRecibe;

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

    public function getTemperatura(): ?float
    {
        return $this->temperatura;
    }

    public function setTemperatura(?float $temperatura): self
    {
        $this->temperatura = $temperatura;

        return $this;
    }

    public function getPresionAbsoluta(): ?float
    {
        return $this->presion_absoluta;
    }

    public function setPresionAbsoluta(?float $presion_absoluta): self
    {
        $this->presion_absoluta = $presion_absoluta;

        return $this;
    }
}
