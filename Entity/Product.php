<?php

namespace Acme\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

    /**
        * @ORM\Entity
        * @ORM\Table(name="product")
        */

class Product {

    /**
        * @ORM\Id
        * @ORM\Column(type="integer")
        * @ORM\GeneratedValue(strategy="AUTO")
        */

    protected $id;

    /**
     * @ORM\Column(type="string", length="100")
     * @Assert\NotBlank()
     */

    protected $name;

    /**
     * @ORM\Column(type="decimal", scale="2")
     * @Assert\NotBlank()
     * @Assert\Min(2)
     */

    protected $price;

    /**
        * @ORM\Column(type="string")
        */

    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @Assert\Type(type="Acme\StoreBundle\Entity\Category")
     */

    protected $category;

    /**
     * Get id
     *
     * @return integer 
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
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param decimal $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return decimal 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set category
     *
     * @param Acme\StoreBundle\Entity\Category $category
     */
    public function setCategory(\Acme\StoreBundle\Entity\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Acme\StoreBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function __toString()
    {
        return $this->name;
    }
}