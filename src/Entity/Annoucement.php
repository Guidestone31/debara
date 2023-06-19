<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annoucement
 *
 * @ORM\Table(name="annoucement", indexes={@ORM\Index(name="IDX_E23D8BAACCFA12B8", columns={"profile_id"}), @ORM\Index(name="IDX_E23D8BAAEEC97447", columns={"sub_category_one_id"})})
 * @ORM\Entity
 */
class Annoucement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @var float|null
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="blob", length=0, nullable=true)
     */
    private $image;

    /**
     * @var \Profile
     *
     * @ORM\ManyToOne(targetEntity="Profile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     * })
     */
    private $profile;

    /**
     * @var \SubCategoryOne
     *
     * @ORM\ManyToOne(targetEntity="SubCategoryOne")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sub_category_one_id", referencedColumnName="id")
     * })
     */
    private $subCategoryOne;


}
