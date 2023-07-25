<?php

namespace App\Entity;

use App\Repository\AnnoucementRepository;
use App\Entity\Traits\SlugTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnnoucementRepository::class)]
class Annoucement
{
    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    public ?float $Price = null;

    #[ORM\Column(length: 255)]
    public ?string $Description = null;

    #[ORM\ManyToOne(inversedBy: 'annoucements', targetEntity: VillesFrance::class)]
    #[ORM\JoinColumn(name: "villesfrance_id", referencedColumnName: "ville_id", nullable: false, onDelete: "CASCADE")]
    private ?VillesFrance $villesfrance_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: 'Le nom du produit ne peut pas être vide')]
    #[Assert\Length(
        min: 8,
        max: 200,
        minMessage: 'Le titre doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le titre ne doit pas faire plus de {{ limit }} caractères'
    )]
    private ?string $Nom = null;

    #[ORM\ManyToOne(inversedBy: 'annoucements', targetEntity: SubCategoryOne::class)]
    #[ORM\JoinColumn(name: "sub_category_o_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?SubCategoryOne $SubCategoryO = null;


    #[ORM\ManyToOne(inversedBy: 'annoucements', targetEntity: User::class)]
    #[ORM\JoinColumn(name: "created_by_id", referencedColumnName: "id", nullable: true, onDelete: "CASCADE")]
    private ?User $createdBy = null;

    #[ORM\OneToMany(mappedBy: 'annoucements', targetEntity: Picture::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $pictures;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Paiement $PaimentId = null;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getVillesfranceId(): ?VillesFrance
    {
        return $this->villesfrance_id;
    }
    public function setVillesfranceId(?VillesFrance $villesfrance_id): self
    {
        $this->villesfrance_id = $villesfrance_id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getSubCategoryO(): ?SubCategoryOne
    {
        return $this->SubCategoryO;
    }

    public function setSubCategoryO(?SubCategoryOne $SubCategoryO): static
    {
        $this->SubCategoryO = $SubCategoryO;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */

    public function getPictures(): Collection
    {
        return $this->pictures;
    }
    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            //$this->pictures->add($picture);
            $picture->setAnnoucement($this);
        }

        return $this;
    }
    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getAnnoucement() === $this) {
                $picture->setAnnoucement(null);
            }
        }

        return $this;
    }

    public function getPaimentId(): ?Paiement
    {
        return $this->PaimentId;
    }

    public function setPaimentId(?Paiement $PaimentId): static
    {
        $this->PaimentId = $PaimentId;

        return $this;
    }
}
