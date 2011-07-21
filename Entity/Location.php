<?php

namespace Acme\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\StoreBundle\Entity\Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity
 */
class Location
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
     * @ORM\ManyToOne(targetEntity="Community", inversedBy="locations")
     * @ORM\JoinColumn(name="community_id", referencedColumnName="id")
     */
    private $community;

    /**
     * @ORM\ManyToOne(targetEntity="Province", inversedBy="locations")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id")
     */
    private $province;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string $street
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;


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
     * Set community
     *
     * @param string $community
     */
    public function setCommunity($community)
    {
        $this->community = $community;
    }

    /**
     * Get community
     *
     * @return string 
     */
    public function getCommunity()
    {
        return $this->community;
    }

    /**
     * Set province
     *
     * @param string $province
     */
    public function setProvince($province)
    {
        $this->province = $province;
    }

    /**
     * Get province
     *
     * @return string 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    public function __toString()
    {
        return sprintf("%s, %s, %s, %s",
            $this->street,
            $this->city,
            $this->community,
            $this->province);
    }
}