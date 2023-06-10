<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $FirstName = null;

    #[ORM\Column(length: 50)]
    private ?string $LastName = null;


    #[ORM\Column(nullable: true)]
    private ?int $PhoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Adress = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $Picture = null;

    #[ORM\OneToOne(inversedBy: 'Profile', cascade: ['persist', 'remove'])]
    private ?User $User = null;

    #[ORM\OneToMany(mappedBy: 'Profile', targetEntity: Annoucement::class)]
    private Collection $Annoucements;

    public function __construct()
    {
        $this->Annoucements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(?int $PhoneNumber): self
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->Adress;
    }

    public function setAdress(?string $Adress): self
    {
        $this->Adress = $Adress;

        return $this;
    }

    public function getPicture()
    {
        return $this->Picture;
    }

    public function setPicture($Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection<int, Annoucement>
     */
    public function getAnnoucements(): Collection
    {
        return $this->Annoucements;
    }

    public function addAnnoucement(Annoucement $annoucement): self
    {
        if (!$this->Annoucements->contains($annoucement)) {
            $this->Annoucements->add($annoucement);
            $annoucement->setProfile($this);
        }

        return $this;
    }

    public function removeAnnoucement(Annoucement $annoucement): self
    {
        if ($this->Annoucements->removeElement($annoucement)) {
            // set the owning side to null (unless already changed)
            if ($annoucement->getProfile() === $this) {
                $annoucement->setProfile(null);
            }
        }

        return $this;
    }
}
