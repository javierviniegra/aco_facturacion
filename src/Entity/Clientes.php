<?php

namespace App\Entity;

use App\Repository\ClientesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientesRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Clientes
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
    private $rfc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombreComercial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $razonSocial;

    /**
     * @ORM\Column(type="smallint")
     */
    private $razon;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\OneToMany(targetEntity=Domicilios::class, mappedBy="cliente", orphanRemoval=true, cascade={"persist"})
     */
    private $domicilio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=ClienteContactos::class, mappedBy="cliente", cascade={"persist"})
     */
    private $contactos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $formaPago;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numRegistro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diasCredito;

    /**
     * @ORM\Column(type="string", length=255)
     */
     private $emailEnvio;

    /**
     * @ORM\ManyToOne(targetEntity=UsoCfdi::class, inversedBy="clientes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $usoCfdi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email1_factura;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email2_factura;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email3_factura;

    /**
     * @ORM\ManyToOne(targetEntity=FormasPagoClientes::class, inversedBy="clientes")
     */
    private $formasDePago;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $calle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numExterior;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numInterior;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colonia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\ManyToOne(targetEntity=Estados::class)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=Paises::class)
     */
    private $pais;

    public function __construct()
    {
        $this->domicilio = new ArrayCollection();
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
        $this->emailEnvio = "email@prueba.com";
        $this->formaPago = "_";
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
        return $this->getNombreComercial();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNombreComercial(): ?string
    {
        return $this->nombreComercial;
    }

    public function setNombreComercial(string $nombreComercial): self
    {
        $this->nombreComercial = $nombreComercial;

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
    public function getDomicilio(): Collection
    {
        return $this->domicilio;
    }

    public function addDomicilio(Domicilios $domicilio): self
    {
        if (!$this->domicilio->contains($domicilio)) {
            $this->domicilio[] = $domicilio;
            $domicilio->setCliente($this);
        }

        return $this;
    }

    public function removeDomicilio(Domicilios $domicilio): self
    {
        if ($this->domicilio->removeElement($domicilio)) {
            // set the owning side to null (unless already changed)
            if ($domicilio->getCliente() === $this) {
                $domicilio->setCliente(null);
            }
        }

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

    /**
     * @return Collection|ClienteContactos[]
     */
    public function getContactos(): Collection
    {
        return $this->contactos;
    }

    public function addContacto(ClienteContactos $contacto): self
    {
        if (!$this->contactos->contains($contacto)) {
            $this->contactos[] = $contacto;
            $contacto->setCliente($this);
        }

        return $this;
    }

    public function removeContacto(ClienteContactos $contacto): self
    {
        if ($this->contactos->removeElement($contacto)) {
            // set the owning side to null (unless already changed)
            if ($contacto->getCliente() === $this) {
                $contacto->setCliente(null);
            }
        }

        return $this;
    }

    public function getFormaPago(): ?string
    {
        return $this->formaPago;
    }

    public function setFormaPago(string $formaPago): self
    {
        $this->formaPago = $formaPago;

        return $this;
    }

    public function getNumRegistro(): ?string
    {
        return $this->numRegistro;
    }

    public function setNumRegistro(string $numRegistro): self
    {
        $this->numRegistro = $numRegistro;

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

    public function getEmailEnvio(): ?string
    {
        return $this->emailEnvio;
    }

    public function setEmailEnvio(string $emailEnvio): self
    {
        $this->emailEnvio = $emailEnvio;

        return $this;
    }

    public function getUsoCfdi(): ?UsoCfdi
    {
        return $this->usoCfdi;
    }

    public function setUsoCfdi(?UsoCfdi $usoCfdi): self
    {
        $this->usoCfdi = $usoCfdi;

        return $this;
    }

    public function getEmail1Factura(): ?string
    {
        return $this->email1_factura;
    }

    public function setEmail1Factura(?string $email1_factura): self
    {
        $this->email1_factura = $email1_factura;

        return $this;
    }

    public function getEmail2Factura(): ?string
    {
        return $this->email2_factura;
    }

    public function setEmail2Factura(?string $email2_factura): self
    {
        $this->email2_factura = $email2_factura;

        return $this;
    }

    public function getEmail3Factura(): ?string
    {
        return $this->email3_factura;
    }

    public function setEmail3Factura(?string $email3_factura): self
    {
        $this->email3_factura = $email3_factura;

        return $this;
    }

    public function getFormasDePago(): ?FormasPagoClientes
    {
        return $this->formasDePago;
    }

    public function setFormasDePago(?FormasPagoClientes $formasDePago): self
    {
        $this->formasDePago = $formasDePago;

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

    public function getNumExterior(): ?string
    {
        return $this->numExterior;
    }

    public function setNumExterior(?string $numExterior): self
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

    public function setColonia(?string $colonia): self
    {
        $this->colonia = $colonia;

        return $this;
    }

    public function getCodigoPostal(): ?string
    {
        return $this->codigoPostal;
    }

    public function setCodigoPostal(?string $codigoPostal): self
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

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getEstado(): ?Estados
    {
        return $this->estado;
    }

    public function setEstado(?Estados $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getPais(): ?Paises
    {
        return $this->pais;
    }

    public function setPais(?Paises $pais): self
    {
        $this->pais = $pais;

        return $this;
    }
}
