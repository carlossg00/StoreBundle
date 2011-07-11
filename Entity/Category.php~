<?php

namespace Acme\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Acme\StoreBundle\Entity\Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */

    protected $products;


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add products
     *
     * @param Acme\StoreBundle\Entity\Product $products
     */
    public function addProducts(\Acme\StoreBundle\Entity\Product $products)
    {
        $this->products[] = $products;
    }

    /**
     * Get products
     *
     * @return Doctrine\Common\Collections\Collection $products
     */
    public function getProducts()
    {
        return $this->products;
    }

    public function __toString()
    {
        return $this->name;
    }
}