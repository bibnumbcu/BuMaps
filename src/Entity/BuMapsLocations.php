<?php
namespace BuMaps\Entity;

use Omeka\Entity\AbstractEntity;
use Omeka\Entity\Item;

/**
 * Defines the default state of an item's map.
 *
 * @Entity
 */
class BuMapsLocations extends AbstractEntity
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="float")
     */
    protected $latitude;

    /**
     * @Column(type="float")
     */
    protected $longitude;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $address;

    /**
     * @Column(type="integer")
     */
    protected $notFound;


    public function getId()
    {
        return $this->id;
    }

    public function setLatitude(int $latitude)
    {
        $this->latitude = $latitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLongitude(int $longitude)
    {
        $this->longitude = $longitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAdress()
    {
        return $this->adress;
    }

    public function setNotFound(int $notFound)
    {
        $this->notFound = $notFound;
    }

    public function getNotFound()
    {
        return $this->notFound;
    }
}
