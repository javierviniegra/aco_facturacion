<?php

namespace App\Entity;

use App\Repository\ProductosVentaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductosVentaRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class ProductosVenta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $litros;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $precioLitro;

    /**
     * @ORM\ManyToOne(targetEntity=Productos::class)
     */
    private $producto;

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
     * @ORM\Column(type="float", nullable=true)
     */
    private $precioFlete;

    /**
     * @ORM\ManyToOne(targetEntity=Ventas::class, inversedBy="productosVenta")
     */
    private $ventas;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $retencion;


    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->is_active = true;
    }

    public function __toString()
    {
        return $this->getProducto()->getNombre();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getProducto(): ?Productos
    {
        return $this->producto;
    }

    public function setProducto(?Productos $producto): self
    {
        $this->producto = $producto;

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

    public function getPrecioFlete(): ?float
    {
        return $this->precioFlete;
    }

    public function setPrecioFlete(?float $precioFlete): self
    {
        $this->precioFlete = $precioFlete;

        return $this;
    }

    public function getVentas(): ?Ventas
    {
        return $this->ventas;
    }

    public function setVentas(?Ventas $ventas): self
    {
        $this->ventas = $ventas;

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

    public function getRetencion(): ?float
    {
        return $this->retencion;
    }

    public function setRetencion(?float $retencion): self
    {
        $this->retencion = $retencion;

        return $this;
    }
}
