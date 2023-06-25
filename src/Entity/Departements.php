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

    private ?string $numDepartement = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'Departements')]
    #[ORM\JoinColumn(name: "id_region_dpt", referencedColumnName: "num_region")]
    private ?Regions $idRegionDpt;

    #[ORM\OneToMany(mappedBy: 'Departements', targetEntity: Annoucement::class, cascade: ['persist', 'remove'])]
    private Collection $annoucement;

    public function __construct()
    {
        $this->annoucement = new ArrayCollection();
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
        return $this->idRegionDpt;
    }

    public function setIdRegionDpt(?Regions $idRegionDpt): self
    {
        $this->idRegionDpt = $idRegionDpt;

        return $this;
    }
    /**
     * @return Collection|annoucement[]
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
}
