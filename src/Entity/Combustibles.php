<?php

namespace App\Entity;

use App\Repository\CombustiblesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=CombustiblesRepository::class) 
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class Combustibles
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
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     mimeTypesMessage = "Please upload a valid Image"
     * )
     * @Vich\UploadableField(mapping="combustible_image", fileNameProperty="imagen", size="imagen_size")
     * 
     * @var File|null
     */
    private $combustible_file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $imagen_size;

    /**
     * @ORM\ManyToOne(targetEntity=Productos::class)
     */
    private $producto;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $ieps;


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

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

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

    /*------ Combustible File ---*/
   public function setCombustibleFile(?File $combustible_file = null): void
    {
        $this->combustible_file = $combustible_file;

        if (null !== $combustible_file) {
            $this->updated_at = new \DateTime();
        }
    }
    public function getCombustibleFile(): ?File
    {
        return $this->combustible_file;
    }
    public function getImagen(): ?string
    {
        return $this->imagen;
    }
    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }
    public function getImagenSize(): ?int
    {
        return $this->imagen_size;
    }
    public function setImagenSize(?int $imagen_size): self
    {
        $this->imagen_size = $imagen_size;

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

    public function getIeps(): ?float
    {
        return $this->ieps;
    }

    public function setIeps(?float $ieps): self
    {
        $this->ieps = $ieps;

        return $this;
    }
}
