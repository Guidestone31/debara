<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DepartementsRepository;

#[ORM\Entity(repositoryClass: DepartementsRepository::class)]
class Departements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?string $numDepartement;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\ManyToOne(targetEntity: Regions::class, inversedBy: 'Departements')]
    #[ORM\JoinColumn(name: "id_region_dpt", referencedColumnName: "num_region")]

    private ?Regions $Regions;

    #[ORM\OneToMany(mappedBy: 'departement_id', targetEntity: Annoucement::class, cascade: ['persist', 'remove'])]
    private Collection $annoucement;

    #[ORM\OneToMany(mappedBy: 'Departements', targetEntity: VillesFrance::class, cascade: ['persist', 'remove'])]
    private Collection $villesfrance;

    public function __construct()
    {
        $this->annoucement = new ArrayCollection();
        $this->villesfrance = new ArrayCollection();
    }

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
        return $this->Regions;
    }

    public function setIdRegionDpt(?Regions $idRegionDpt): self
    {
        $this->Regions = $idRegionDpt;

        return $this;
    }
    /**
     * @return Collection<int, Annoucement>
     */
    public function getAnnoucement(): Collection
    {
        return $this->annoucement;
    }
    /*
    public function addAnnoucement(annoucement $annoucements): self
    {
        if (!$this->annoucement->contains($annoucements)) {
            $this->annoucement[] = $annoucements;
            $annoucements->setDepartements($this);
        }

        return $this;
    }

    public function removeAnnoucement(annoucement $annoucements): self
    {
        if ($this->annoucement->removeElement($annoucements)) {
            // set the owning side to null (unless already changed)
            if ($annoucements->getDepartements() === $this) {
                $annoucements->setDepartements(null);
            }
        }

        return $this;
    }*/
    /**
     * @return Collection|VillesFrance[]
     */

    public function getVillesFrance(): Collection
    {
        return $this->villesfrance;
    }
    public function __toString()
    {
        return (string) $this->nom;
    }
}
