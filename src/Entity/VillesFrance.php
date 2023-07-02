<?php

namespace App\Entity;

use Cassandra\Smallint;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\String_;

#[ORM\Entity(repositoryClass: "App\Repository\VillesFranceRepository")]
class VillesFrance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $villeId;

    #[ORM\Column(length: 45)]
    private ?string $villeNom = null;

    #[ORM\Column(length: 255)]
    private ?string $villeCodePostal = null;

    #[ORM\ManyToOne(targetEntity: Departements::class, inversedBy: 'VillesFrance')]
    #[ORM\JoinColumn(name: "departement_code", referencedColumnName: "num_departement")]
    private ?Departements $departements;

    /*#[ORM\OneToMany(mappedBy: 'villesfrance', targetEntity: Annoucement::class, cascade: ['persist', 'remove'])]
    private Collection $annoucement;*/

    #[ORM\OneToMany(mappedBy: 'villesfrance_id', targetEntity: Annoucement::class, cascade: ['persist', 'remove'])]
    private Collection $annoucements;
    /*
        #[ORM\OneToMany(mappedBy: 'villesfrance', targetEntity: Annoucement::class, cascade: ['persist', 'remove'])]
        private Collection $villesfrance;
*/
    public function __construct()
    {
        //$this->annoucements = new ArrayCollection();
        //$this->villesfrance = new ArrayCollection();
        $this->annoucements = new ArrayCollection();
    }

    public function getVilleId(): ?int
    {
        return $this->villeId;
    }

    public function getVilleNom(): ?string
    {
        return $this->villeNom;
    }

    public function setVilleNom(?string $villeNom): self
    {
        $this->villeNom = $villeNom;

        return $this;
    }

    public function getVilleCodePostal(): ?string
    {
        return $this->villeCodePostal;
    }

    public function setVilleCodePostal(?string $villeCodePostal): self
    {
        $this->villeCodePostal = $villeCodePostal;

        return $this;
    }

    public function getDepartementCode(): ?Departements
    {
        return $this->departements;
    }

    public function setDepartementCode(?Departements $departementCode): self
    {
        $this->departements = $departementCode;

        return $this;
    }
    /*
    public function addVillesfrance(Annoucement $villesfrance): static
    {
        if (!$this->Villesfrance->contains($villesfrance)) {
            $this->Villesfrance->add($villesfrance);
            $villesfrance->setVillesfrance($this);
        }

        return $this;
    }

    public function removeVillesfrance(Annoucement $villesfrance): static
    {
        if ($this->Villesfrance->removeElement($villesfrance)) {
            // set the owning side to null (unless already changed)
            if ($villesfrance->getVillesfrance() === $this) {
                $villesfrance->setVillesfrance(null);
            }
        }

        return $this;
    }*/

    /**
     * @return Collection<int, Annoucement>
     */
    public function getAnnoucements(): Collection
    {
        return $this->annoucements;
    }
    /*
    public function addAnnoucement(Annoucement $annoucement): static
    {
        if (!$this->annoucements->contains($annoucement)) {
            $this->annoucements->add($annoucement);
            $annoucement->setVillesfranceId($this);
        }

        return $this;
    }

    public function removeAnnoucement(Annoucement $annoucement): static
    {
        if ($this->annoucements->removeElement($annoucement)) {
            // set the owning side to null (unless already changed)
            if ($annoucement->getVillesfranceId() === $this) {
                $annoucement->setVillesfranceId(null);
            }
        }

        return $this;
    }*/
    public function __toString()
    {
        return (string) $this->villeNom;
    }
}
