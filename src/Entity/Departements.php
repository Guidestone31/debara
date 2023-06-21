<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementsRepository::class)]
class Departements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private $numDepartement;

    #[ORM\Column(length: 50)]
    private $nom;

    #[ORM\ManyToOne(inversedBy: 'Departements')]
    private $idRegionDpt;

    public function getNumDepartement(): ?int
    {
        return $this->numDepartement;
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
    public function getIdRegionDpt(): ?Regions
    {
        return $this->idRegionDpt;
    }

    public function setIdRegionDpt(?Regions $idRegionDpt): self
    {
        $this->idRegionDpt = $idRegionDpt;

        return $this;
    }
}
