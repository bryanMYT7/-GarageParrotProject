<?php

namespace App\Entity;


use App\Form\ImageType;
use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $circulation_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometers;
    /**
     * @ORM\Column(type="string")
     */
    private $brand;
    /**
     * @ORM\Column(type="string")
     */
    private $category;
    /**
     * @ORM\Column(type="string")
     */
    private $model;
 
    /**
     * @var File|null
     *
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $imageFilename;

    /**
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true)
     */
    private $image;


    public function getId(): ?int
    {
        return $this->id;
    }

    // ... other getter and setter methods

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): void
{
    $this->imageFile = $imageFile;

    if ($imageFile instanceof UploadedFile) {
        // Handle file upload logic here, if needed
        // For example, if you want to set the updated timestamp
        $this->updatedAt = new \DateTimeImmutable();
    }
}

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename(?string $imageFilename): void
    {
        $this->imageFilename = $imageFilename;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): void
    {
        $this->image = $image;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCirculationDate(): ?\DateTimeInterface
    {
        return $this->circulation_date;
    }

    public function setCirculationDate(\DateTimeInterface $circulation_date): self
    {
        $this->circulation_date = $circulation_date;

        return $this;
    }

    public function getKilometers(): ?int
    {
        return $this->kilometers;
    }

    public function setKilometers(int $kilometers): self
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    /**
     * Get the value of brand
     */ 
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set the value of brand
     *
     * @return  self
     */ 
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get the value of model
     */ 
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */ 
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }


    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}
