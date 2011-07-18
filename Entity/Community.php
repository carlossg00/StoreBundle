<?php

namespace Acme\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Acme\StoreBundle\Entity\Community
 *
 * @ORM\Table(name="community")
 * @ORM\Entity
 */
class Community
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
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Community", mappedBy="community")
     */
    private $provinces;

    /**
     * @ORM\OneToMany(targetEntity="Location", mappedBy="province")
     */
    private $locations;


    public function __construct()
    {
        $this->provinces = new ArrayCollection();
        $this->locations = new ArrayCollection();
    }


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
     * Add provinces
     *
     * @param Acme\StoreBundle\Entity\Community $provinces
     */
    public function addProvinces(\Acme\StoreBundle\Entity\Community $provinces)
    {
        $this->provinces[] = $provinces;
    }

    /**
     * Get provinces
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProvinces()
    {
        return $this->provinces;
    }

    /**
     * Add locations
     *
     * @param Acme\StoreBundle\Entity\Location $locations
     */
    public function addLocations(\Acme\StoreBundle\Entity\Location $locations)
    {
        $this->locations[] = $locations;
    }

    /**
     * Get locations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLocations()
    {
        return $this->locations;
    }

    public function __toString()
    {
        return $this->name;
    }
}