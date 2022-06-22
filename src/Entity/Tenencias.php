<?php

namespace App\Entity;

use App\Repository\TenenciasRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TenenciasRepository::class)
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class Tenencias
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $monto;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fotografia;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int|null
     */
    private $fotografiaSize;

    /**
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     * @Vich\UploadableField(mapping="foto_tenencia_image", fileNameProperty="fotografia", size="fotografia_size")
     * @var File|null
     */
    private $fotografiaFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=InventariosInfraestructura::class, inversedBy="tenencias")
     */
    private $inventariosInfraestructura;

    public function __construct()
    {
        if(is_null($this->fecha))
            $this->fecha = new \DateTime();
    }

    public function __toString()
    {
        return $this->getMonto();
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonto(): ?float
    {
        return $this->monto;
    }

    public function setMonto(float $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }


    /*------ Fotografia File ---*/
   public function setFotografiaFile(?File $fotografiaFile = null): void
    {
        $this->fotografiaFile = $fotografiaFile;

        //if (null !== $fotografiaFile) {  //esto arregla el error de que no s esuben archivos en colecciones o relaciones de archivos
        if ($fotografiaFile) {
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

    public function getInventariosInfraestructura(): ?InventariosInfraestructura
    {
        return $this->inventariosInfraestructura;
    }

    public function setInventariosInfraestructura(?InventariosInfraestructura $inventariosInfraestructura): self
    {
        $this->inventariosInfraestructura = $inventariosInfraestructura;

        return $this;
    }
}
