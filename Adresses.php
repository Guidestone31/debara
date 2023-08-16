<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresses
 *
 * @ORM\Table(name="Adresses", indexes={@ORM\Index(name="FK_ville_adresses", columns={"Id_adresse_ville"})})
 * @ORM\Entity
 */
class Adresses
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAdresse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idadresse;

    /**
     * @var int|null
     *
     * @ORM\Column(name="numRue", type="smallint", nullable=true)
     */
    private $numrue;

    /**
     * @var string
     *
     * @ORM\Column(name="rue", type="string", length=25, nullable=false)
     */
    private $rue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codePostal", type="string", length=255, nullable=true)
     */
    private $codepostal;

    /**
     * @var \VillesFrance
     *
     * @ORM\ManyToOne(targetEntity="VillesFrance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_adresse_ville", referencedColumnName="ville_id")
     * })
     */
    private $idAdresseVille;
}
