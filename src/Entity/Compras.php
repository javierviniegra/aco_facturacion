<?php

namespace App\Entity;

use App\Repository\ComprasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComprasRepository::class) 
 * @ORM\HasLifecycleCallbacks()
 */
class Compras
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaCompra;

    /**
     * @ORM\ManyToOne(targetEntity=Proveedores::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $proveedor;

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
     * @ORM\JoinColumn(nullable=true)
     */
    private $producto;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $iepsFactor;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $iepsTotal;

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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaPago;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numFactura;

    /**
     * @ORM\ManyToOne(targetEntity=FormasPago::class)
     */
    private $formaPago;

    /**
     * @ORM\ManyToOne(targetEntity=Bancos::class)
     */
    private $banco;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idTransaccion;

    /**
     * @ORM\ManyToOne(targetEntity=EstatusPago::class)
     */
    private $estatusPago;

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
    private $personaRecibio;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $id_compra;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $requiereIeps;

    /**
     * @ORM\OneToMany(targetEntity=CompraProductos::class, mappedBy="compras", cascade={"persist"})
     */
    private $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
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
        if (is_null($this->getIdCompra()))
            return "";
        else
            return $this->getIdCompra();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaCompra(): ?\DateTimeInterface
    {
        return $this->fechaCompra;
    }

    public function setFechaCompra(\DateTimeInterface $fechaCompra): self
    {
        $this->fechaCompra = $fechaCompra;

        return $this;
    }

    public function getProveedor(): ?Proveedores
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedores $proveedor): self
    {
        $this->proveedor = $proveedor;

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

    public function getProducto(): ?Productos
    {
        return $this->producto;
    }

    public function setProducto(?Productos $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    public function getIepsFactor(): ?float
    {
        return $this->iepsFactor;
    }

    public function setIepsFactor(?float $iepsFactor): self
    {
        $this->iepsFactor = $iepsFactor;

        return $this;
    }

    public function getIepsTotal(): ?float
    {
        return $this->iepsTotal;
    }

    public function setIepsTotal(?float $iepsTotal): self
    {
        $this->iepsTotal = $iepsTotal;

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

    public function getFechaPago(): ?\DateTimeInterface
    {
        return $this->fechaPago;
    }

    public function setFechaPago(?\DateTimeInterface $fechaPago): self
    {
        $this->fechaPago = $fechaPago;

        return $this;
    }

    public function getNumFactura(): ?string
    {
        return $this->numFactura;
    }

    public function setNumFactura(?string $numFactura): self
    {
        $this->numFactura = $numFactura;

        return $this;
    }

    public function getFormaPago(): ?FormasPago
    {
        return $this->formaPago;
    }

    public function setFormaPago(?FormasPago $formaPago): self
    {
        $this->formaPago = $formaPago;

        return $this;
    }

    public function getBanco(): ?Bancos
    {
        return $this->banco;
    }

    public function setBanco(?Bancos $banco): self
    {
        $this->banco = $banco;

        return $this;
    }

    public function getIdTransaccion(): ?string
    {
        return $this->idTransaccion;
    }

    public function setIdTransaccion(?string $idTransaccion): self
    {
        $this->idTransaccion = $idTransaccion;

        return $this;
    }

    public function getEstatusPago(): ?EstatusPago
    {
        return $this->estatusPago;
    }

    public function setEstatusPago(?EstatusPago $estatusPago): self
    {
        $this->estatusPago = $estatusPago;

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

    public function getPersonaRecibio(): ?SonataUserUser
    {
        return $this->personaRecibio;
    }

    public function setPersonaRecibio(?SonataUserUser $personaRecibio): self
    {
        $this->personaRecibio = $personaRecibio;

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

    public function getIdCompra(): ?string
    {
        return $this->id_compra;
    }

    public function setIdCompra(?string $id_compra): self
    {
        $this->id_compra = $id_compra;

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

    /**
     * @return Collection<int, CompraProductos>
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(CompraProductos $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
            $producto->setCompras($this);
        }

        return $this;
    }

    public function removeProducto(CompraProductos $producto): self
    {
        if ($this->productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getCompras() === $this) {
                $producto->setCompras(null);
            }
        }

        return $this;
    }
}
