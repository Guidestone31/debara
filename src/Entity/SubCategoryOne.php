<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubCategoryOne
 *
 * @ORM\Table(name="sub_category_one", indexes={@ORM\Index(name="IDX_48FC6C9D12469DE2", columns={"category_id"})})
 * @ORM\Entity
 */
class SubCategoryOne
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
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;


}
