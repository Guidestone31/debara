<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementsRepository::class)]
class Departements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $numDepartement = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'Departements')]
    #[ORM\JoinColumn(name: "id_region_dpt", referencedColumnName: "num_region")]
    private ?Regions $idRegionDpt;

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
