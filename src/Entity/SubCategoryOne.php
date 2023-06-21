<?php

namespace App\Entity;

use App\Repository\SubCategoryOneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubCategoryOneRepository::class)]
#[ORM\Table(name: "sub_category_one")]
class SubCategoryOne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(length: 50)]
    private ?string $Name = null;

    #[ORM\ManyToOne(inversedBy: 'sub_category_one')]
    private Category $category;

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
    public function getProfile(): ?Category
    {
        return $this->category;
    }

    public function setProfile(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
