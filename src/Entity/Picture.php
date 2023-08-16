<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Annoucement::class, inversedBy: 'pictures')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Annoucement $annoucements;
    /*
        #[ORM\Column(type: Types::BLOB, nullable: true)]
        private $ImageFile;
    */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAnnoucement(): ?Annoucement
    {
        return $this->annoucements;
    }

    public function setAnnoucement(?Annoucement $annoucements): self
    {
        $this->annoucements = $annoucements;

        return $this;
    }
    /*
    public function getImageFile()
    {
        return $this->ImageFile;
    }

    public function setImageFile($ImageFile): self
    {
        $this->ImageFile = $ImageFile;

        return $this;
    }*/
}
