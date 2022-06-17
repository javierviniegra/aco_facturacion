<?php

namespace App\Entity;

use App\Repository\ProveedoresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Validator as ConexionAssert; //para validar el RFC
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProveedoresRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Proveedores
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
     * @ORM\Column(type="string", length=255)
     * @ConexionAssert\IsRfc
     */
    private $rfc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $razonSocial;

    /**
     * @ORM\Column(type="smallint")
     */
    private $razon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $calle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numInterior;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numExterior;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colonia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $municipio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefono1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefono2;

    /**
     * @ORM\OneToMany(targetEntity=ProveedorContactos::class, mappedBy="proveedores",cascade={"persist"})
     */
    private $contactos;

    /**
     * @ORM\Column(type="boolean")
     */
    private $manejoCredito;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $limiteCredito;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diasCredito;

    /**
     * @ORM\ManyToOne(targetEntity=FormasPago::class)
     */
    private $formaPago;

    /**
     * @ORM\ManyToOne(targetEntity=Bancos::class)
     */
    private $banco1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cuentaContable1;

    /**
     * @ORM\ManyToOne(targetEntity=Bancos::class)
     */
    private $banco2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cuentaContable2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $porcentajeDescuento;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $webpage;

    /**
     * @ORM\ManyToOne(targetEntity=Estados::class)
     */
    private $estado1;

    /**
     * @ORM\ManyToOne(targetEntity=Paises::class)
     */
    private $pais1;

    public function __construct()
    {
        $this->contactos = new ArrayCollection();
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

    public function getRfc(): ?string
    {
        return $this->rfc;
    }

    public function setRfc(string $rfc): self
    {
        $this->rfc = $rfc;

        return $this;
    }

    public function getRazonSocial(): ?string
    {
        return $this->razonSocial;
    }

    public function setRazonSocial(string $razonSocial): self
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    public function getRazon(): ?int
    {
        return $this->razon;
    }

    public function setRazon(int $razon): self
    {
        $this->razon = $razon;

        return $this;
    }

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(?string $calle): self
    {
        $this->calle = $calle;

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

    public function getNumExterior(): ?string
    {
        return $this->numExterior;
    }

    public function setNumExterior(?string $numExterior): self
    {
        $this->numExterior = $numExterior;

        return $this;
    }

    public function getColonia(): ?string
    {
        return $this->colonia;
    }

    public function setColonia(?string $colonia): self
    {
        $this->colonia = $colonia;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(?string $cp): self
    {
        $this->cp = $cp;

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

    public function setEstado(?string $estado): self
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

    public function setTelefono1(?string $telefono1): self
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

    /**
     * @return Collection|ProveedorContactos[]
     */
    public function getContactos(): Collection
    {
        return $this->contactos;
    }

    public function addContacto(ProveedorContactos $contacto): self
    {
        if (!$this->contactos->contains($contacto)) {
            $this->contactos[] = $contacto;
            $contacto->setProveedores($this);
        }

        return $this;
    }

    public function removeContacto(ProveedorContactos $contacto): self
    {
        if ($this->contactos->removeElement($contacto)) {
            // set the owning side to null (unless already changed)
            if ($contacto->getProveedores() === $this) {
                $contacto->setProveedores(null);
            }
        }

        return $this;
    }

    public function getManejoCredito(): ?bool
    {
        return $this->manejoCredito;
    }

    public function setManejoCredito(bool $manejoCredito): self
    {
        $this->manejoCredito = $manejoCredito;

        return $this;
    }

    public function getLimiteCredito(): ?float
    {
        return $this->limiteCredito;
    }

    public function setLimiteCredito(?float $limiteCredito): self
    {
        $this->limiteCredito = $limiteCredito;

        return $this;
    }

    public function getDiasCredito(): ?string
    {
        return $this->diasCredito;
    }

    public function setDiasCredito(?string $diasCredito): self
    {
        $this->diasCredito = $diasCredito;

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

    public function getBanco1(): ?Bancos
    {
        return $this->banco1;
    }

    public function setBanco1(?Bancos $banco1): self
    {
        $this->banco1 = $banco1;

        return $this;
    }

    public function getCuentaContable1(): ?string
    {
        return $this->cuentaContable1;
    }

    public function setCuentaContable1(?string $cuentaContable1): self
    {
        $this->cuentaContable1 = $cuentaContable1;

        return $this;
    }

    public function getBanco2(): ?Bancos
    {
        return $this->banco2;
    }

    public function setBanco2(?Bancos $banco2): self
    {
        $this->banco2 = $banco2;

        return $this;
    }

    public function getCuentaContable2(): ?string
    {
        return $this->cuentaContable2;
    }

    public function setCuentaContable2(?string $cuentaContable2): self
    {
        $this->cuentaContable2 = $cuentaContable2;

        return $this;
    }

    public function getPorcentajeDescuento(): ?int
    {
        return $this->porcentajeDescuento;
    }

    public function setPorcentajeDescuento(?int $porcentajeDescuento): self
    {
        $this->porcentajeDescuento = $porcentajeDescuento;

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

    public function getWebpage(): ?string
    {
        return $this->webpage;
    }

    public function setWebpage(?string $webpage): self
    {
        $this->webpage = $webpage;

        return $this;
    }

    public function getEstado1(): ?Estados
    {
        return $this->estado1;
    }

    public function setEstado1(?Estados $estado1): self
    {
        $this->estado1 = $estado1;

        return $this;
    }

    public function getPais1(): ?Paises
    {
        return $this->pais1;
    }

    public function setPais1(?Paises $pais1): self
    {
        $this->pais1 = $pais1;

        return $this;
    }
}
