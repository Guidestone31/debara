<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VillesFrance
 *
 * @ORM\Table(name="Villes_france", uniqueConstraints={@ORM\UniqueConstraint(name="ville_slug", columns={"ville_slug"}), @ORM\UniqueConstraint(name="ville_code_commune_2", columns={"ville_code_commune"})}, indexes={@ORM\Index(name="ville_nom_metaphone", columns={"ville_nom_metaphone"}), @ORM\Index(name="ville_longitude_latitude_deg", columns={"ville_longitude_deg", "ville_latitude_deg"}), @ORM\Index(name="ville_nom_reel", columns={"ville_nom_reel"}), @ORM\Index(name="ville_population_2010", columns={"ville_population_2010"}), @ORM\Index(name="ville_code_commune", columns={"ville_code_commune"}), @ORM\Index(name="ville_departement", columns={"departement_code"}), @ORM\Index(name="ville_nom_simple", columns={"ville_nom_simple"}), @ORM\Index(name="ville_nom_soundex", columns={"ville_nom_soundex"}), @ORM\Index(name="ville_code_postal", columns={"ville_code_postal"}), @ORM\Index(name="ville_nom", columns={"ville_nom"})})
 * @ORM\Entity
 */
class VillesFrance
{
    /**
     * @var int
     *
     * @ORM\Column(name="ville_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $villeId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_slug", type="string", length=255, nullable=true)
     */
    private $villeSlug;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_nom", type="string", length=45, nullable=true)
     */
    private $villeNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_nom_simple", type="string", length=45, nullable=true)
     */
    private $villeNomSimple;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_nom_reel", type="string", length=45, nullable=true)
     */
    private $villeNomReel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_nom_soundex", type="string", length=20, nullable=true)
     */
    private $villeNomSoundex;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_nom_metaphone", type="string", length=22, nullable=true)
     */
    private $villeNomMetaphone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_code_postal", type="string", length=255, nullable=true)
     */
    private $villeCodePostal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_commune", type="string", length=3, nullable=true)
     */
    private $villeCommune;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_code_commune", type="string", length=5, nullable=false)
     */
    private $villeCodeCommune;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ville_arrondissement", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $villeArrondissement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_canton", type="string", length=4, nullable=true)
     */
    private $villeCanton;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ville_amdi", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $villeAmdi;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ville_population_2010", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $villePopulation2010;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ville_population_1999", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $villePopulation1999;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ville_population_2012", type="integer", nullable=true, options={"unsigned"=true,"comment"="approximatif"})
     */
    private $villePopulation2012;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ville_densite_2010", type="integer", nullable=true)
     */
    private $villeDensite2010;

    /**
     * @var float|null
     *
     * @ORM\Column(name="ville_surface", type="float", precision=10, scale=0, nullable=true)
     */
    private $villeSurface;

    /**
     * @var float|null
     *
     * @ORM\Column(name="ville_longitude_deg", type="float", precision=10, scale=0, nullable=true)
     */
    private $villeLongitudeDeg;

    /**
     * @var float|null
     *
     * @ORM\Column(name="ville_latitude_deg", type="float", precision=10, scale=0, nullable=true)
     */
    private $villeLatitudeDeg;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_longitude_grd", type="string", length=9, nullable=true)
     */
    private $villeLongitudeGrd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_latitude_grd", type="string", length=8, nullable=true)
     */
    private $villeLatitudeGrd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_longitude_dms", type="string", length=9, nullable=true)
     */
    private $villeLongitudeDms;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville_latitude_dms", type="string", length=8, nullable=true)
     */
    private $villeLatitudeDms;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ville_zmin", type="integer", nullable=true)
     */
    private $villeZmin;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ville_zmax", type="integer", nullable=true)
     */
    private $villeZmax;

    /**
     * @var \Departements
     *
     * @ORM\ManyToOne(targetEntity="Departements")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="departement_code", referencedColumnName="num_departement")
     * })
     */
    private $departementCode;


}
