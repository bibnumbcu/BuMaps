<?php
namespace BuMaps\Entity;

use Omeka\Entity\AbstractEntity;
use Omeka\Entity\Item;

/**
 * Defines the default state of an item's map.
 *
 * @Entity
 */
class BuMapsResourcesLocations extends AbstractEntity
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
    * @ManyToOne(targetEntity="Omeka\Entity\Resource")
    * @JoinColumn(onDelete="cascade", nullable=false)
    */
    protected $resource;

     /**
     * @ManyToOne(targetEntity="BuMaps\Entity\BuMapsLocations")
     * @JoinColumn(onDelete="cascade", nullable=false) 
     */
    protected $location;




    public function getId()
    {
        return $this->id;
    }

    public function setResourceId(int $resource)
    {
        $this->resource = $resource;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setLocation(int $location)
    {
        $this->location = $location;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
