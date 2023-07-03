<?php

namespace App\Entity;

use App\Repository\SubCategoryOneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'SubCategoryO', targetEntity: Annoucement::class)]
    private Collection $annoucements;

    public function __construct()
    {
        $this->annoucements = new ArrayCollection();
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
    public function getProfile(): ?Category
    {
        return $this->category;
    }

    public function setProfile(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Annoucement>
     */
    public function getAnnoucements(): Collection
    {
        return $this->annoucements;
    }

    public function addAnnoucement(Annoucement $annoucement): static
    {
        if (!$this->annoucements->contains($annoucement)) {
            $this->annoucements->add($annoucement);
            $annoucement->setSubCategoryO($this);
        }

        return $this;
    }

    public function removeAnnoucement(Annoucement $annoucement): static
    {
        if ($this->annoucements->removeElement($annoucement)) {
            // set the owning side to null (unless already changed)
            if ($annoucement->getSubCategoryO() === $this) {
                $annoucement->setSubCategoryO(null);
            }
        }

        return $this;
    }
}
