<?php

namespace App\Entity;

use App\Repository\RegionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionsRepository::class)]
class Regions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $numRegion;

    #[ORM\Column(length: 50)]
    private $nom;

    public function getNumRegion(): ?int
    {
        return $this->numRegion;
    }
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}
