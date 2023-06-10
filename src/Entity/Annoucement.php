<?php

namespace App\Entity;

use App\Repository\AnnoucementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnoucementRepository::class)]
class Annoucement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    public ?string $Product_Name = null;

    #[ORM\Column(length: 50)]
    public ?string $Product_Category = null;

    #[ORM\Column]
    public ?float $Product_Price = null;

    #[ORM\Column(length: 255)]
    public ?string $Product_Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Image = null;

    #[ORM\OneToOne(mappedBy: 'Annoucement', cascade: ['persist', 'remove'])]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'Annoucements')]
    private ?Profile $Profile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->Product_Name;
    }

    public function setProductName(string $Product_Name): self
    {
        $this->Product_Name = $Product_Name;

        return $this;
    }

    public function getProductCategory(): ?string
    {
        return $this->Product_Category;
    }

    public function setProductCategory(string $Product_Category): self
    {
        $this->Product_Category = $Product_Category;

        return $this;
    }

    public function getProductPrice(): ?float
    {
        return $this->Product_Price;
    }

    public function setProductPrice(float $Product_Price): self
    {
        $this->Product_Price = $Product_Price;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->Product_Description;
    }

    public function setProductDescription(string $Product_Description): self
    {
        $this->Product_Description = $Product_Description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        // set the owning side of the relation if necessary
        if ($product->getAnnoucement() !== $this) {
            $product->setAnnoucement($this);
        }

        $this->product = $product;

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->Profile;
    }

    public function setProfile(?Profile $Profile): self
    {
        $this->Profile = $Profile;

        return $this;
    }
}
