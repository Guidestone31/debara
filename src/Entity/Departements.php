<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DepartementsRepository;

#[ORM\Entity(repositoryClass: DepartementsRepository::class)]
class Departements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?string $numDepartement = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'Departements')]
    #[ORM\JoinColumn(name: "id_region_dpt", referencedColumnName: "num_region")]
    private ?Regions $idRegionDpt;

    public function getNumDepartement(): ?string
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
