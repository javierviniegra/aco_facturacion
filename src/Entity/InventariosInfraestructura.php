<?php

namespace App\Entity;

use App\Repository\InventariosInfraestructuraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InventariosInfraestructuraRepository::class)
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class InventariosInfraestructura
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
    private $id_transporte;

    /**
     * @ORM\ManyToOne(targetEntity=TipoCamion::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipo_camion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unidad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $serie;

    /**
     * @ORM\OneToOne(targetEntity=TarjetasCirculacion::class, cascade={"persist", "remove"})
     */
    private $tarjeta_circulacion;

    /**
     * @ORM\OneToOne(targetEntity=SegurosAuto::class, cascade={"persist", "remove"})
     */
    private $SeguroAuto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $permiso_sct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $modelo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placa;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacidad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equipo_especial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facturaField;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $factura;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int|null
     */
    private $factura_size;

    /**
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     * @Vich\UploadableField(mapping="foto_factura_image", fileNameProperty="factura", size="factura_size")
     * @var File|null
     */
    private $facturaFile;

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
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\OneToMany(targetEntity=Tenencias::class, mappedBy="inventariosInfraestructura", cascade={"persist"})
     */
    private $tenencias;

    /**
     * @ORM\OneToMany(targetEntity=Verificaciones::class, mappedBy="inventariosInfraestructura", cascade={"persist"})
     */
    private $verificaciones;


    public function __toString()
    {
        return $this->getUnidad();
    }

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

    public function __construct()
    {     
        if(is_null($this->is_active))
            $this->is_active = true;
        $this->tenencias = new ArrayCollection();
        $this->verificaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTransporte(): ?string
    {
        return $this->id_transporte;
    }

    public function setIdTransporte(string $id_transporte): self
    {
        $this->id_transporte = $id_transporte;

        return $this;
    }

    public function getTipoCamion(): ?TipoCamion
    {
        return $this->tipo_camion;
    }

    public function setTipoCamion(?TipoCamion $tipo_camion): self
    {
        $this->tipo_camion = $tipo_camion;

        return $this;
    }

    public function getUnidad(): ?string
    {
        return $this->unidad;
    }

    public function setUnidad(string $unidad): self
    {
        $this->unidad = $unidad;

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

    public function getTarjetaCirculacion(): ?TarjetasCirculacion
    {
        return $this->tarjeta_circulacion;
    }

    public function setTarjetaCirculacion(?TarjetasCirculacion $tarjeta_circulacion): self
    {
        $this->tarjeta_circulacion = $tarjeta_circulacion;

        return $this;
    }

    public function getPermisoSct(): ?string
    {
        return $this->permiso_sct;
    }

    public function setPermisoSct(?string $permiso_sct): self
    {
        $this->permiso_sct = $permiso_sct;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(?string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getPlaca(): ?string
    {
        return $this->placa;
    }

    public function setPlaca(string $placa): self
    {
        $this->placa = $placa;

        return $this;
    }

    public function getCapacidad(): ?int
    {
        return $this->capacidad;
    }

    public function setCapacidad(?int $capacidad): self
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    public function getDomos(): ?string
    {
        return $this->domos;
    }

    public function setDomos(?string $domos): self
    {
        $this->domos = $domos;

        return $this;
    }

    public function getSeguroAuto(): ?SegurosAuto
    {
        return $this->SeguroAuto;
    }

    public function setSeguroAuto(?SegurosAuto $SeguroAuto): self
    {
        $this->SeguroAuto = $SeguroAuto;

        return $this;
    }

    public function getEquipoEspecial(): ?string
    {
        return $this->equipo_especial;
    }

    public function setEquipoEspecial(?string $equipo_especial): self
    {
        $this->equipo_especial = $equipo_especial;

        return $this;
    }

    public function getFacturaField(): ?string
    {
        return $this->facturaField;
    }

    public function setFacturaField(?string $facturaField): self
    {
        $this->facturaField = $facturaField;

        return $this;
    }


    /*------ Factura File ---*/
   public function setFacturaFile(?File $facturaFile = null): void
    {
        $this->facturaFile = $facturaFile;

        if (null !== $facturaFile) {
            $this->updatedAt = new \DateTime();
        }
    }
    public function getFacturaFile(): ?File
    {
        return $this->facturaFile;
    }   
    public function setFacturaSize(?int $facturaSize): void
    {
        $this->facturaSize = $facturaSize;
    }
    public function getFacturaSize(): ?int
    {
        return $this->facturaSize;
    }
    public function getFactura(): ?string
    {
        return $this->factura;
    }
    public function setFactura(?string $factura): self
    {
        $this->factura = $factura;
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
     * @return Collection<int, Tenencias>
     */
    public function getTenencias(): Collection
    {
        return $this->tenencias;
    }

    public function addTenencia(Tenencias $tenencia): self
    {
        if (!$this->tenencias->contains($tenencia)) {
            $this->tenencias[] = $tenencia;
            $tenencia->setInventariosInfraestructura($this);
        }

        return $this;
    }

    public function removeTenencia(Tenencias $tenencia): self
    {
        if ($this->tenencias->removeElement($tenencia)) {
            // set the owning side to null (unless already changed)
            if ($tenencia->getInventariosInfraestructura() === $this) {
                $tenencia->setInventariosInfraestructura(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Verificaciones>
     */
    public function getVerificaciones(): Collection
    {
        return $this->verificaciones;
    }

    public function addVerificacione(Verificaciones $verificacione): self
    {
        if (!$this->verificaciones->contains($verificacione)) {
            $this->verificaciones[] = $verificacione;
            $verificacione->setInventariosInfraestructura($this);
        }

        return $this;
    }

    public function removeVerificacione(Verificaciones $verificacione): self
    {
        if ($this->verificaciones->removeElement($verificacione)) {
            // set the owning side to null (unless already changed)
            if ($verificacione->getInventariosInfraestructura() === $this) {
                $verificacione->setInventariosInfraestructura(null);
            }
        }

        return $this;
    }
}
