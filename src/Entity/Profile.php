<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use function PHPSTORM_META\map;

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

    #[ORM\OneToMany(mappedBy: 'profileId', targetEntity: Annoucement::class)]
    private Collection $annoucements;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function __construct()
    {
        //$this->Annoucements = new ArrayCollection();
        $this->annoucements = new ArrayCollection();
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
    /*
    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
*/
    /**
     * @return Collection<int, Annoucement>
     */
    public function getAnnoucements(): Collection
    {
        return $this->annoucements;
    }

    public function addAnnoucement(Annoucement $annoucement): static
    {
        if (!$this->annoucements->contains($annoucement)) {
            $this->annoucements->add($annoucement);
            $annoucement->setProfileId($this);
        }

        return $this;
    }

    public function removeAnnoucement(Annoucement $annoucement): static
    {
        if ($this->annoucements->removeElement($annoucement)) {
            // set the owning side to null (unless already changed)
            if ($annoucement->getProfileId() === $this) {
                $annoucement->setProfileId(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
