<?php

namespace App\Entity;

use Cassandra\Smallint;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\String_;

#[ORM\Entity(repositoryClass: VillesFranceRepository::class)]
class VillesFrance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $villeId = null;

    #[ORM\Column(length: 255)]
    private ?string $villeSlug = null;

    #[ORM\Column(length: 45)]
    private ?string $villeNom = null;

    #[ORM\Column(length: 45)]
    private ?string $villeNomSimple = null;

    #[ORM\Column(length: 45)]
    private ?string $villeNomReel = null;

    #[ORM\Column(length: 20)]
    private ?string $villeNomSoundex = null;

    #[ORM\Column(length: 22)]
    private ?string $villeNomMetaphone = null;

    #[ORM\Column(length: 255)]
    private ?string $villeCodePostal = null;

    #[ORM\Column(length: 3)]
    private ?string $villeCommune = null;

    #[ORM\Column(length: 5)]
    private ?string $villeCodeCommune;

    #[ORM\Column(name: "ville_arrondissement", type: "smallint", nullable: true, options: ["unsigned" => true])]
    private ?int $villeArrondissement = null;

    #[ORM\Column(name: "ville_canton", nullable: true, length: 4)]
    private ?string $villeCanton = null;

    #[ORM\Column(name: "ville_amdi", type: "smallint", nullable: true, options: ["unsigned" => true])]
    private ?int $villeAmdi = null;

    #[ORM\Column(name: "ville_population_2010", type: "integer", nullable: true, options: ["unsigned" => true])]
    private ?int $villePopulation2010 = null;

    #[ORM\Column(name: "ville_population_1999", type: "integer", nullable: true, options: ["unsigned" => true])]
    private ?int $villePopulation1999 = null;

    #[ORM\Column(name: "ville_population_2012", type: "integer", nullable: true, options: ["unsigned" => true, "comment" => "approximatif"])]
    private ?int $villePopulation2012 = null;

    #[ORM\Column(name: "ville_densite_2010", type: "integer", nullable: true)]
    private ?int $villeDensite2010 = null;

    #[ORM\Column(name: "ville_surface", type: "float", precision: 10, scale: 0, nullable: true)]
    private ?float $villeSurface = null;

    #[ORM\Column(name: "ville_Longitude_Deg", type: "float", precision: 10, scale: 0, nullable: true)]
    private ?float  $villeLongitudeDeg = null;

    #[ORM\Column(name: "ville_Latitude_Deg", type: "float", precision: 10, scale: 0, nullable: true)]
    private ?float $villeLatitudeDeg = null;

    #[ORM\Column(name: "ville_Longitude_Grd", type: "string", precision: 10, scale: 0, nullable: true, length: 9)]
    private ?string $villeLongitudeGrd = null;

    #[ORM\Column(name: "ville_Latitude_Grd", type: "string", precision: 10, scale: 0, nullable: true, length: 8)]
    private ?string $villeLatitudeGrd = null;

    #[ORM\Column(name: "ville_Longitude_Dms", type: "string", precision: 10, scale: 0, nullable: true, length: 9)]
    private ?string $villeLongitudeDms = null;

    #[ORM\Column(name: "ville_Latitude_Dms", type: "string", precision: 10, scale: 0, nullable: true, length: 8)]
    private ?string $villeLatitudeDms = null;

    #[ORM\Column(nullable: true)]
    private ?int $villeZmin = null;

    #[ORM\Column(nullable: true)]
    private ?int $villeZmax = null;

    #[ORM\ManyToOne(inversedBy: 'VillesFrance')]
    #[ORM\JoinColumn(name: "departement_code", referencedColumnName: "num_departement")]
    private ?Departements $departementCode;

    public function getVilleId(): ?int
    {
        return $this->villeId;
    }

    public function getVilleSlug(): ?string
    {
        return $this->villeSlug;
    }

    public function setVilleSlug(?string $villeSlug): static
    {
        $this->villeSlug = $villeSlug;

        return $this;
    }

    public function getVilleNom(): ?string
    {
        return $this->villeNom;
    }

    public function setVilleNom(?string $villeNom): static
    {
        $this->villeNom = $villeNom;

        return $this;
    }

    public function getVilleNomSimple(): ?string
    {
        return $this->villeNomSimple;
    }

    public function setVilleNomSimple(?string $villeNomSimple): static
    {
        $this->villeNomSimple = $villeNomSimple;

        return $this;
    }

    public function getVilleNomReel(): ?string
    {
        return $this->villeNomReel;
    }

    public function setVilleNomReel(?string $villeNomReel): static
    {
        $this->villeNomReel = $villeNomReel;

        return $this;
    }

    public function getVilleNomSoundex(): ?string
    {
        return $this->villeNomSoundex;
    }

    public function setVilleNomSoundex(?string $villeNomSoundex): static
    {
        $this->villeNomSoundex = $villeNomSoundex;

        return $this;
    }

    public function getVilleNomMetaphone(): ?string
    {
        return $this->villeNomMetaphone;
    }

    public function setVilleNomMetaphone(?string $villeNomMetaphone): static
    {
        $this->villeNomMetaphone = $villeNomMetaphone;

        return $this;
    }

    public function getVilleCodePostal(): ?string
    {
        return $this->villeCodePostal;
    }

    public function setVilleCodePostal(?string $villeCodePostal): static
    {
        $this->villeCodePostal = $villeCodePostal;

        return $this;
    }

    public function getVilleCommune(): ?string
    {
        return $this->villeCommune;
    }

    public function setVilleCommune(?string $villeCommune): static
    {
        $this->villeCommune = $villeCommune;

        return $this;
    }

    public function getVilleCodeCommune(): ?string
    {
        return $this->villeCodeCommune;
    }

    public function setVilleCodeCommune(string $villeCodeCommune): static
    {
        $this->villeCodeCommune = $villeCodeCommune;

        return $this;
    }

    public function getVilleArrondissement(): ?int
    {
        return $this->villeArrondissement;
    }

    public function setVilleArrondissement(?int $villeArrondissement): static
    {
        $this->villeArrondissement = $villeArrondissement;

        return $this;
    }

    public function getVilleCanton(): ?string
    {
        return $this->villeCanton;
    }

    public function setVilleCanton(?string $villeCanton): static
    {
        $this->villeCanton = $villeCanton;

        return $this;
    }

    public function getVilleAmdi(): ?int
    {
        return $this->villeAmdi;
    }

    public function setVilleAmdi(?int $villeAmdi): static
    {
        $this->villeAmdi = $villeAmdi;

        return $this;
    }

    public function getVillePopulation2010(): ?int
    {
        return $this->villePopulation2010;
    }

    public function setVillePopulation2010(?int $villePopulation2010): static
    {
        $this->villePopulation2010 = $villePopulation2010;

        return $this;
    }

    public function getVillePopulation1999(): ?int
    {
        return $this->villePopulation1999;
    }

    public function setVillePopulation1999(?int $villePopulation1999): static
    {
        $this->villePopulation1999 = $villePopulation1999;

        return $this;
    }

    public function getVillePopulation2012(): ?int
    {
        return $this->villePopulation2012;
    }

    public function setVillePopulation2012(?int $villePopulation2012): static
    {
        $this->villePopulation2012 = $villePopulation2012;

        return $this;
    }

    public function getVilleDensite2010(): ?int
    {
        return $this->villeDensite2010;
    }

    public function setVilleDensite2010(?int $villeDensite2010): static
    {
        $this->villeDensite2010 = $villeDensite2010;

        return $this;
    }

    public function getVilleSurface(): ?float
    {
        return $this->villeSurface;
    }

    public function setVilleSurface(?float $villeSurface): static
    {
        $this->villeSurface = $villeSurface;

        return $this;
    }

    public function getVilleLongitudeDeg(): ?float
    {
        return $this->villeLongitudeDeg;
    }

    public function setVilleLongitudeDeg(?float $villeLongitudeDeg): static
    {
        $this->villeLongitudeDeg = $villeLongitudeDeg;

        return $this;
    }

    public function getVilleLatitudeDeg(): ?float
    {
        return $this->villeLatitudeDeg;
    }

    public function setVilleLatitudeDeg(?float $villeLatitudeDeg): static
    {
        $this->villeLatitudeDeg = $villeLatitudeDeg;

        return $this;
    }

    public function getVilleLongitudeGrd(): ?string
    {
        return $this->villeLongitudeGrd;
    }

    public function setVilleLongitudeGrd(?string $villeLongitudeGrd): static
    {
        $this->villeLongitudeGrd = $villeLongitudeGrd;

        return $this;
    }

    public function getVilleLatitudeGrd(): ?string
    {
        return $this->villeLatitudeGrd;
    }

    public function setVilleLatitudeGrd(?string $villeLatitudeGrd): static
    {
        $this->villeLatitudeGrd = $villeLatitudeGrd;

        return $this;
    }

    public function getVilleLongitudeDms(): ?string
    {
        return $this->villeLongitudeDms;
    }

    public function setVilleLongitudeDms(?string $villeLongitudeDms): static
    {
        $this->villeLongitudeDms = $villeLongitudeDms;

        return $this;
    }

    public function getVilleLatitudeDms(): ?string
    {
        return $this->villeLatitudeDms;
    }

    public function setVilleLatitudeDms(?string $villeLatitudeDms): static
    {
        $this->villeLatitudeDms = $villeLatitudeDms;

        return $this;
    }

    public function getVilleZmin(): ?int
    {
        return $this->villeZmin;
    }

    public function setVilleZmin(?int $villeZmin): static
    {
        $this->villeZmin = $villeZmin;

        return $this;
    }

    public function getVilleZmax(): ?int
    {
        return $this->villeZmax;
    }

    public function setVilleZmax(?int $villeZmax): static
    {
        $this->villeZmax = $villeZmax;

        return $this;
    }

    public function getDepartementCode(): ?Departements
    {
        return $this->departementCode;
    }

    public function setDepartementCode(?Departements $departementCode): static
    {
        $this->departementCode = $departementCode;

        return $this;
    }
}
