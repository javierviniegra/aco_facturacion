<?php

namespace App\Entity;

use App\Repository\TarjetasCirculacionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TarjetasCirculacionRepository::class) 
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class TarjetasCirculacion
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
    private $numero;

    /**
     * @ORM\Column(type="datetime")
     */
    private $vigencia;

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
     * @Vich\UploadableField(mapping="tarjeta_circulacion_image", fileNameProperty="fotografia", size="fotografia_size")
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

    public function __construct()
    {
        if(is_null($this->vigencia))
            $this->vigencia = new \DateTime();
    }


    public function __toString()
    {
        return $this->getNumero();
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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getVigencia(): ?\DateTimeInterface
    {
        return $this->vigencia;
    }

    public function setVigencia(?\DateTimeInterface $vigencia): self
    {
        $this->vigencia = $vigencia;

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
}
