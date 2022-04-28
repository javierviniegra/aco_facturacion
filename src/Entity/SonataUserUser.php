<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 * @ORM\Table(name="fos_user__user")
 */
class SonataUserUser extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname_2;

    /**
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     * @Vich\UploadableField(mapping="rfc_image", fileNameProperty="rfc", size="rfcSize")
     * @var File|null
     */
    private $rfcFile;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rfc;
    /**
     * @ORM\Column(type="integer")
     * @var int|null
     */
    private $rfcSize;

    /**
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     * @Vich\UploadableField(mapping="curp_image", fileNameProperty="curp", size="curpSize")
     * @var File|null
     */
    private $curpFile;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $curp;
    /**
     * @ORM\Column(type="integer")
     * @var int|null
     */
    private $curpSize;

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
    private $municipio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     * @Vich\UploadableField(mapping="domicilio_image", fileNameProperty="comprobanteDomicilio", size="domicilioSize")
     * 
     * @var File|null
     */
    private $domicilioFile;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comprobanteDomicilio;
    /**
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $domicilioSize;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaIngreso;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numImss;

    /**
     * @ORM\OneToOne(targetEntity=Puesto::class, cascade={"persist"})
     */
    private $puesto;

    /**
     * @ORM\OneToOne(targetEntity=TipoSangre::class, cascade={"persist"})
     */
    private $tipoSangre;

    /**
     * @ORM\OneToOne(targetEntity=EstadoCivil::class, cascade={"persist"})
     */
    private $estadoCivil;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $anotacionesMedicas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $celular;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telCasa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contacto1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $celContacto1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contacto2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $celContacto2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $georeferencia;

    /**
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     mimeTypesMessage = "Please upload a valid Image"
     * )
     * @Vich\UploadableField(mapping="fotografia_image", fileNameProperty="fotografia", size="fotografiaSize")
     * @var File|null
     */
    private $fotografiaFile;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fotografia;
    /**
     * @ORM\Column(type="integer")
     * @var int|null
     */
    private $fotografiaSize;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numero_nomina;

    /**
     * @ORM\OneToMany(targetEntity=Salario::class, mappedBy="sonataUserUser",cascade={"persist"})
     */
    private $sueldos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rfc_field;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $curp_field;

    /**
     * @ORM\OneToOne(targetEntity=UserFuncion::class, cascade={"persist", "remove"})
     */
    private $funcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombreContacto1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telContacto1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombreContacto2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telContacto2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $licencia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vigencia;

    /**
     * @ORM\ManyToOne(targetEntity=TiposLicencia::class)
     */
    private $tipo_licencia;


    public function __toString()
    {
        return $this->getFirstname()." ".$this->getLastname()." - ".$this->getUsername();
    }

    public function __construct()
    {   
        parent::__construct();
        $this->roles = array('ROLE_DENTISTA');
        $this->salario = new ArrayCollection();
        $this->sueldos = new ArrayCollection();
    }

    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    public function getLastname2(): ?string
    {
        return $this->lastname_2;
    }

    public function setLastname2(?string $lastname_2): self
    {
        $this->lastname_2 = $lastname_2;

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

    public function getMunicipio(): ?string
    {
        return $this->municipio;
    }

    public function setMunicipio(?string $municipio): self
    {
        $this->municipio = $municipio;

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

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getFechaIngreso(): ?\DateTimeInterface
    {
        return $this->fechaIngreso;
    }

    public function setFechaIngreso(?\DateTimeInterface $fechaIngreso): self
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    public function getNumImss(): ?string
    {
        return $this->numImss;
    }

    public function setNumImss(?string $numImss): self
    {
        $this->numImss = $numImss;

        return $this;
    }

    public function getPuesto(): ?puesto
    {
        return $this->puesto;
    }

    public function setPuesto(puesto $puesto): self
    {
        $this->puesto = $puesto;

        return $this;
    }

    public function getTipoSangre(): ?TipoSangre
    {
        return $this->tipoSangre;
    }

    public function setTipoSangre(?TipoSangre $tipoSangre): self
    {
        $this->tipoSangre = $tipoSangre;

        return $this;
    }

    public function getEstadoCivil(): ?EstadoCivil
    {
        return $this->estadoCivil;
    }

    public function setEstadoCivil(?EstadoCivil $estadoCivil): self
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    public function getAnotacionesMedicas(): ?string
    {
        return $this->anotacionesMedicas;
    }

    public function setAnotacionesMedicas(?string $anotacionesMedicas): self
    {
        $this->anotacionesMedicas = $anotacionesMedicas;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getTelCasa(): ?string
    {
        return $this->telCasa;
    }

    public function setTelCasa(?string $telCasa): self
    {
        $this->telCasa = $telCasa;

        return $this;
    }

    public function getContacto1(): ?string
    {
        return $this->contacto1;
    }

    public function setContacto1(?string $contacto1): self
    {
        $this->contacto1 = $contacto1;

        return $this;
    }

    public function getCelContacto1(): ?string
    {
        return $this->celContacto1;
    }

    public function setCelContacto1(?string $celContacto1): self
    {
        $this->celContacto1 = $celContacto1;

        return $this;
    }

    public function getContacto2(): ?string
    {
        return $this->contacto2;
    }

    public function setContacto2(?string $contacto2): self
    {
        $this->contacto2 = $contacto2;

        return $this;
    }

    public function getCelContacto2(): ?string
    {
        return $this->celContacto2;
    }

    public function setCelContacto2(?string $celContacto2): self
    {
        $this->celContacto2 = $celContacto2;

        return $this;
    }

    public function getGeoreferencia(): ?string
    {
        return $this->georeferencia;
    }

    public function setGeoreferencia(?string $georeferencia): self
    {
        $this->georeferencia = $georeferencia;

        return $this;
    }

    /*------ Comprobante de Domicilio File ---*/
   public function setDomicilioFile(?File $domicilioFile = null): void
    {
        $this->domicilioFile = $domicilioFile;

        if (null !== $domicilioFile) {
            $this->updatedAt = new \DateTime();
        }
    }
    public function getDomicilioFile(): ?File
    {
        return $this->domicilioFile;
    }   
    public function setDomicilioSize(?int $domicilioSize): void
    {
        $this->domicilioSize = $domicilioSize;
    }
    public function getDomicilioSize(): ?int
    {
        return $this->domicilioSize;
    }
    public function getComprobanteDomicilio(): ?string
    {
        return $this->comprobanteDomicilio;
    }
    public function setComprobanteDomicilio(?string $comprobanteDomicilio): self
    {
        $this->comprobanteDomicilio = $comprobanteDomicilio;

        return $this;
    }

    public function getNumeroNomina(): ?string
    {
        return $this->numero_nomina;
    }

    public function setNumeroNomina(?string $numero_nomina): self
    {
        $this->numero_nomina = $numero_nomina;

        return $this;
    }

    public function getRfcField(): ?string
    {
        return $this->rfc_field;
    }

    public function setRfcField(?string $rfc_field): self
    {
        $this->rfc_field = $rfc_field;

        return $this;
    }

    public function getCurpField(): ?string
    {
        return $this->curp_field;
    }

    public function setCurpField(?string $curp_field): self
    {
        $this->curp_field = $curp_field;

        return $this;
    }

    /*------ RFC File ---*/
   public function setRfcFile(?File $rfcFile = null): void
    {
        $this->rfcFile = $rfcFile;

        if (null !== $rfcFile) {
            $this->updatedAt = new \DateTime();
        }
    }
    public function getRfcFile(): ?File
    {
        return $this->rfcFile;
    }   
    public function setRfcSize(?int $rfcSize): void
    {
        $this->rfcSize = $rfcSize;
    }
    public function getRfcSize(): ?int
    {
        return $this->rfcSize;
    }
    public function getRfc(): ?string
    {
        return $this->rfc;
    }
    public function setRfc(?string $rfc): self
    {
        $this->rfc = $rfc;

        return $this;
    }


    /*------ CURP File ---*/
   public function setCurpFile(?File $curpFile = null): void
    {
        $this->curpFile = $curpFile;

        if (null !== $curpFile) {
            $this->updatedAt = new \DateTime();
        }
    }
    public function getCurpFile(): ?File
    {
        return $this->curpFile;
    }   
    public function setCurpSize(?int $curpSize): void
    {
        $this->curpSize = $curpSize;
    }
    public function getCurpSize(): ?int
    {
        return $this->curpSize;
    }
    public function getCurp(): ?string
    {
        return $this->curp;
    }
    public function setCurp(?string $curp): self
    {
        $this->curp = $curp;

        return $this;
    }


    /*------ Fotografia File ---*/
   public function setFotografiaFile(?File $fotografiaFile = null): void
    {
        $this->fotografiaFile = $fotografiaFile;

        if (null !== $fotografiaFile) {
            $this->updatedAt = new \DateTime();
        }
    }
    public function getFotografiaFile(): ?File
    {
        return $this->fotografiaFile;
    }   
    public function setFotografiaSize(?int $fotografiaSize): void
    {
        $this->fotografiaSize = $fotografiaSize;
    }
    public function getFotografiaSize(): ?int
    {
        return $this->fotografiaSize;
    }
    public function getFotografia(): ?string
    {
        return $this->fotografia;
    }
    public function setFotografia(?string $fotografia): self
    {
        $this->fotografia = $fotografia;

        return $this;
    }

    /**
     * @return Collection|salario[]
     */
    public function getSueldos(): Collection
    {
        return $this->sueldos;
    }

    public function addSueldo(salario $sueldo): self
    {
        if (!$this->sueldos->contains($sueldo)) {
            $this->sueldos[] = $sueldo;
            $sueldo->setSonataUserUser($this);
        }

        return $this;
    }

    public function removeSueldo(salario $sueldo): self
    {
        if ($this->sueldos->removeElement($sueldo)) {
            // set the owning side to null (unless already changed)
            if ($sueldo->getSonataUserUser() === $this) {
                $sueldo->setSonataUserUser(null);
            }
        }

        return $this;
    }

    public function getFuncion(): ?UserFuncion
    {
        return $this->funcion;
    }

    public function setFuncion(?UserFuncion $funcion): self
    {
        $this->funcion = $funcion;

        return $this;
    }

    public function getNombreContacto1(): ?string
    {
        return $this->nombreContacto1;
    }

    public function setNombreContacto1(string $nombreContacto1): self
    {
        $this->nombreContacto1 = $nombreContacto1;

        return $this;
    }

    public function getTelContacto1(): ?string
    {
        return $this->telContacto1;
    }

    public function setTelContacto1(string $telContacto1): self
    {
        $this->telContacto1 = $telContacto1;

        return $this;
    }

    public function getNombreContacto2(): ?string
    {
        return $this->nombreContacto2;
    }

    public function setNombreContacto2(?string $nombreContacto2): self
    {
        $this->nombreContacto2 = $nombreContacto2;

        return $this;
    }

    public function getTelContacto2(): ?string
    {
        return $this->telContacto2;
    }

    public function setTelContacto2(?string $telContacto2): self
    {
        $this->telContacto2 = $telContacto2;

        return $this;
    }

    public function getLicencia(): ?string
    {
        return $this->licencia;
    }

    public function setLicencia(?string $licencia): self
    {
        $this->licencia = $licencia;

        return $this;
    }

    public function getVigencia(): ?string
    {
        return $this->vigencia;
    }

    public function setVigencia(?string $vigencia): self
    {
        $this->vigencia = $vigencia;

        return $this;
    }

    public function getTipoLicencia(): ?TiposLicencia
    {
        return $this->tipo_licencia;
    }

    public function setTipoLicencia(?TiposLicencia $tipo_licencia): self
    {
        $this->tipo_licencia = $tipo_licencia;

        return $this;
    }

}