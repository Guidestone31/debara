<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departements
 *
 * @ORM\Table(name="Departements", indexes={@ORM\Index(name="FK_region_dpt", columns={"id_region_dpt"})})
 * @ORM\Entity
 */
class Departements
{
    /**
     * @var string
     *
     * @ORM\Column(name="num_departement", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numDepartement;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=32, nullable=false, options={"fixed"=true})
     */
    private $nom;

    /**
     * @var \Regions
     *
     * @ORM\ManyToOne(targetEntity="Regions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_region_dpt", referencedColumnName="num_region")
     * })
     */
    private $idRegionDpt;


}
