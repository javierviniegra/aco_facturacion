<?php

namespace App\Entity;

use App\Repository\VentasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VentasRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Ventas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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
    private $id_venta;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity=Clientes::class)
     */
    private $cliente;

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
     * @ORM\OneToMany(targetEntity=ProductosVenta::class, mappedBy="ventas",cascade={"persist"})
     */
    private $productosVenta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $id_factura;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $serie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $folio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaFactura;

    /**
     * @ORM\ManyToOne(targetEntity=FormasPago::class)
     */
    private $formaPago;

    /**
     * @ORM\ManyToOne(targetEntity=MetodosPago::class)
     */
    private $metodoPago;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipoEntrega;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $id_pedido;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $id_camion;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $observacionesFlete;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $quienEntrega;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $dondeEntrega;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $id_cinturon;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaEntrega;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $quienRecibe;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ordenCompletada;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $observacionesEntrega;

    /**
     * @ORM\ManyToOne(targetEntity=Clientes::class)
     */
    private $rfc;

    /**
     * @ORM\ManyToOne(targetEntity=FormasPago::class)
     */
    private $forma_pago;

    /**
     * @ORM\ManyToOne(targetEntity=MetodosPago::class)
     */
    private $metodo_pago;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $flete;

    /**
     * @ORM\ManyToOne(targetEntity=MetodosPagoVentas::class)
     */
    private $metodo_pago1;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_deleted;

    /**
     * @ORM\ManyToOne(targetEntity=SonataUserUser::class)
     */
    private $quien_borro;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_borrado;

    public function __construct()
    {
        $this->productosVenta = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
        $this->is_deleted = False;
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
        if (is_null($this->getIdVenta()))
            return "";
        else
            return $this->getIdVenta();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdVenta(): ?string
    {
        return $this->id_venta;
    }

    public function setIdVenta(?string $id_venta): self
    {
        $this->id_venta = $id_venta;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

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

    /**
     * @return Collection|ProductosVenta[]
     */
    public function getProductosVenta(): Collection
    {
        return $this->productosVenta;
    }

    public function addProductosVentum(ProductosVenta $productosVentum): self
    {
        if (!$this->productosVenta->contains($productosVentum)) {
            $this->productosVenta[] = $productosVentum;
            $productosVentum->setVentas($this);
        }

        return $this;
    }

    public function removeProductosVentum(ProductosVenta $productosVentum): self
    {
        if ($this->productosVenta->removeElement($productosVentum)) {
            // set the owning side to null (unless already changed)
            if ($productosVentum->getVentas() === $this) {
                $productosVentum->setVentas(null);
            }
        }

        return $this;
    }

    public function getIdFactura(): ?string
    {
        return $this->id_factura;
    }

    public function setIdFactura(?string $id_factura): self
    {
        $this->id_factura = $id_factura;

        return $this;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(?string $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getFolio(): ?string
    {
        return $this->folio;
    }

    public function setFolio(?string $folio): self
    {
        $this->folio = $folio;

        return $this;
    }

    public function getFechaFactura(): ?\DateTimeInterface
    {
        return $this->fechaFactura;
    }

    public function setFechaFactura(?\DateTimeInterface $fechaFactura): self
    {
        $this->fechaFactura = $fechaFactura;

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

    public function getMetodoPago(): ?MetodosPago
    {
        return $this->metodoPago;
    }

    public function setMetodoPago(?MetodosPago $metodoPago): self
    {
        $this->metodoPago = $metodoPago;

        return $this;
    }

    public function getTipoEntrega(): ?string
    {
        return $this->tipoEntrega;
    }

    public function setTipoEntrega(?string $tipoEntrega): self
    {
        $this->tipoEntrega = $tipoEntrega;

        return $this;
    }

    public function getIdPedido(): ?string
    {
        return $this->id_pedido;
    }

    public function setIdPedido(?string $id_pedido): self
    {
        $this->id_pedido = $id_pedido;

        return $this;
    }

    public function getIdCamion(): ?string
    {
        return $this->id_camion;
    }

    public function setIdCamion(?string $id_camion): self
    {
        $this->id_camion = $id_camion;

        return $this;
    }

    public function getObservacionesFlete(): ?string
    {
        return $this->observacionesFlete;
    }

    public function setObservacionesFlete(?string $observacionesFlete): self
    {
        $this->observacionesFlete = $observacionesFlete;

        return $this;
    }

    public function getQuienEntrega(): ?string
    {
        return $this->quienEntrega;
    }

    public function setQuienEntrega(?string $quienEntrega): self
    {
        $this->quienEntrega = $quienEntrega;

        return $this;
    }

    public function getDondeEntrega(): ?string
    {
        return $this->dondeEntrega;
    }

    public function setDondeEntrega(?string $dondeEntrega): self
    {
        $this->dondeEntrega = $dondeEntrega;

        return $this;
    }

    public function getIdCinturon(): ?string
    {
        return $this->id_cinturon;
    }

    public function setIdCinturon(?string $id_cinturon): self
    {
        $this->id_cinturon = $id_cinturon;

        return $this;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fechaEntrega;
    }

    public function setFechaEntrega(?\DateTimeInterface $fechaEntrega): self
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    public function getQuienRecibe(): ?string
    {
        return $this->quienRecibe;
    }

    public function setQuienRecibe(?string $quienRecibe): self
    {
        $this->quienRecibe = $quienRecibe;

        return $this;
    }

    public function getOrdenCompletada(): ?bool
    {
        return $this->ordenCompletada;
    }

    public function setOrdenCompletada(?bool $ordenCompletada): self
    {
        $this->ordenCompletada = $ordenCompletada;

        return $this;
    }

    public function getObservacionesEntrega(): ?string
    {
        return $this->observacionesEntrega;
    }

    public function setObservacionesEntrega(?string $observacionesEntrega): self
    {
        $this->observacionesEntrega = $observacionesEntrega;

        return $this;
    }

    public function getRfc(): ?Clientes
    {
        return $this->rfc;
    }

    public function setRfc(?Clientes $rfc): self
    {
        $this->rfc = $rfc;

        return $this;
    }

    public function getFlete(): ?float
    {
        return $this->flete;
    }

    public function setFlete(?float $flete): self
    {
        $this->flete = $flete;

        return $this;
    }

    public function getMetodoPago1(): ?MetodosPagoVentas
    {
        return $this->metodo_pago1;
    }

    public function setMetodoPago1(?MetodosPagoVentas $metodo_pago1): self
    {
        $this->metodo_pago1 = $metodo_pago1;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->is_deleted;
    }

    public function setIsDeleted(?bool $is_deleted): self
    {
        $this->is_deleted = $is_deleted;

        return $this;
    }

    public function getQuienBorro(): ?SonataUserUser
    {
        return $this->quien_borro;
    }

    public function setQuienBorro(?SonataUserUser $quien_borro): self
    {
        $this->quien_borro = $quien_borro;

        return $this;
    }

    public function getFechaBorrado(): ?\DateTimeInterface
    {
        return $this->fecha_borrado;
    }

    public function setFechaBorrado(?\DateTimeInterface $fecha_borrado): self
    {
        $this->fecha_borrado = $fecha_borrado;

        return $this;
    }

}
