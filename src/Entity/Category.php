<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Name = null;

    #[ORM\OneToMany(mappedBy: 'Category', targetEntity: Product::class, orphanRemoval: true)]
    private Collection $products;

    #[ORM\OneToMany(mappedBy: 'Category_Id', targetEntity: Product::class, orphanRemoval: true)]
    private Collection $Product_Id;

    #[ORM\OneToMany(mappedBy: 'Category', targetEntity: Product::class, orphanRemoval: true)]
    private Collection $Products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->Product_Id = new ArrayCollection();
        $this->Products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProductId(): Collection
    {
        return $this->Product_Id;
    }

    public function addProductId(Product $productId): self
    {
        if (!$this->Product_Id->contains($productId)) {
            $this->Product_Id->add($productId);
            $productId->setCategory($this);
        }

        return $this;
    }

    public function removeProductId(Product $productId): self
    {
        if ($this->Product_Id->removeElement($productId)) {
            // set the owning side to null (unless already changed)
            if ($productId->getCategory() === $this) {
                $productId->setCategory(null);
            }
        }

        return $this;
    }
}
