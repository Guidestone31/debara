<?php

namespace App\Entity;

use App\Repository\AnnoucementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnnoucementRepository::class)]
class Annoucement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    public ?float $Price = null;

    #[ORM\Column(length: 255)]
    public ?string $Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Image = null;

    #[ORM\ManyToOne(inversedBy: 'annoucements')]
    #[ORM\JoinColumn(name: "id", referencedColumnName: "id")]
    private ?Profile $Profile = null;

    #[ORM\ManyToOne(inversedBy: 'annoucement', targetEntity: Departements::class)]
    #[ORM\JoinColumn(name: "departement_id", referencedColumnName: "num_departement")]
    private ?Departements $departement_id = null;

    #[ORM\ManyToOne(inversedBy: 'annoucements', targetEntity: VillesFrance::class)]
    #[ORM\JoinColumn(name: "villesfrance_id", referencedColumnName: "ville_id", nullable: false, onDelete: "CASCADE")]
    #[Assert\NotBlank]
    private ?VillesFrance $villesfrance_id = null;
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

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

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
    /*
    public function getVillesFrance(): ?VillesFrance
    {
        return $this->villesfrance;
    }

    public function setVillesFrance(?VillesFrance $villesfrances): self
    {
        $this->villesfrance = $villesfrances;

        return $this;
    }*/
    /*
    public function getDepartements(): ?Departements
    {
        return $this->Departement;
    }

    public function setDepartements(?Departements $departements): self
    {
        $this->Departement = $departements;

        return $this;
    }*/

    public function getDepartementId(): ?Departements
    {
        return $this->departement_id;
    }

    public function setDepartementId(?Departements $departement_id): self
    {
        $this->departement_id = $departement_id;

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
}
