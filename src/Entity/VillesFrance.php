<?php

namespace App\Entity;

use Cassandra\Smallint;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\String_;

#[ORM\Entity(repositoryClass: VillesFranceRepository::class)]
class VillesFrance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $villeId = null;

    #[ORM\Column(length: 45)]
    private ?string $villeNom = null;

    #[ORM\Column(length: 255)]
    private ?string $villeCodePostal = null;

    #[ORM\ManyToOne(inversedBy: 'VillesFrance')]
    #[ORM\JoinColumn(name: "departement_code", referencedColumnName: "num_departement")]
    private ?Departements $departementCode;

    public function getVilleId(): ?int
    {
        return $this->villeId;
    }

    public function getVilleNom(): ?string
    {
        return $this->villeNom;
    }

    public function setVilleNom(?string $villeNom): static
    {
        $this->villeNom = $villeNom;

        return $this;
    }

    public function getVilleCodePostal(): ?string
    {
        return $this->villeCodePostal;
    }

    public function setVilleCodePostal(?string $villeCodePostal): static
    {
        $this->villeCodePostal = $villeCodePostal;

        return $this;
    }

    public function getDepartementCode(): ?Departements
    {
        return $this->departementCode;
    }

    public function setDepartementCode(?Departements $departementCode): static
    {
        $this->departementCode = $departementCode;

        return $this;
    }
}
