<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rfc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $curp;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comprobanteDomicilio;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fotografia;

    public function __construct()
    {   
        parent::__construct();
        $this->roles = array('ROLE_DENTISTA');
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

    public function getRfc(): ?string
    {
        return $this->rfc;
    }

    public function setRfc(?string $rfc): self
    {
        $this->rfc = $rfc;

        return $this;
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

    public function getComprobanteDomicilio(): ?string
    {
        return $this->comprobanteDomicilio;
    }

    public function setComprobanteDomicilio(?string $comprobanteDomicilio): self
    {
        $this->comprobanteDomicilio = $comprobanteDomicilio;

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

    public function getFotografia(): ?string
    {
        return $this->fotografia;
    }

    public function setFotografia(?string $fotografia): self
    {
        $this->fotografia = $fotografia;

        return $this;
    }
}