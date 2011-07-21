<?php

namespace Acme\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="provider")
 */
class Provider
{
    /**
     * @var integer
     * 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     * @Assert\NotBlank(groups="Provider")
     */
    protected $name;


    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank(groups="Provider")
     */
    protected $phone;

    /**
     * @ORM\OneToOne(targetEntity="Location" , cascade={"persist", "remove"} );
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     */
    protected $location;

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
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set location
     *
     * @param Acme\StoreBundle\Entity\Location $location
     */
    public function setLocation(\Acme\StoreBundle\Entity\Location $location)
    {
        $this->location = $location;
    }

    /**
     * Get location
     *
     * @return Acme\StoreBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }

    public function __toString()
    {
        return $this->name;
    }
}