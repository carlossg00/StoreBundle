<?php

namespace Acme\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Acme\StoreBundle\Entity\Province
 *
 * @ORM\Table(name="province")
 * @ORM\Entity
 */
class Province
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
     * @ORM\ManyToOne(targetEntity="Community", inversedBy="provinces")
     * @ORM\JoinColumn(name="community_id", referencedColumnName="id")
     */

    private $community;

    /**
     * @ORM\OneToMany(targetEntity="Location", mappedBy="province")
     */
    private $locations;


    public function __construct()
    {
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
     * Set community
     *
     * @param Acme\StoreBundle\Entity\Community $community
     */
    public function setCommunity(\Acme\StoreBundle\Entity\Community $community)
    {
        $this->community = $community;
    }

    /**
     * Get community
     *
     * @return Acme\StoreBundle\Entity\Community 
     */
    public function getCommunity()
    {
        return $this->community;
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