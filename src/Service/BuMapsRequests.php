<?php

/*
 * Copyright 2020 BibLibre
 *
 * This file is part of ItemSetsTree.
 *
 * ItemSetsTree is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ItemSetsTree is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ItemSetsTree.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace BuMaps\Service;

use Doctrine\ORM\EntityManager;
use BuMaps\Entity\BuMapsLocations;
use BuMaps\Entity\BuMapsResourcesLocations;
use Omeka\Api\Adapter\Manager as ApiAdapterManager;
use Omeka\Api\Manager as ApiManager;
use Omeka\Api\Representation\ItemSetRepresentation;
use Omeka\Entity\ItemSet;
use Doctrine\DBAL\Tools\Dumper;

class BuMapsRequests
{
    protected $em;
    protected $apiServices;
   
    public function setEntityManager($apiServices, EntityManager $em)
    {
        $this->em = $em;
        $this->apiServices = $apiServices;
    }

    public function getCoordinates($type, $resource_id)
    {
        $itemsId = array();
        
        if ($type=='ItemSet'){
            $items = $this->apiServices->search('items', ['item_set_id' => $resource_id])->getContent();
            $itemsId = array_map(function($o) { return $o->id();}, $items);
        }
        else if ($type=='Item'){
            $itemsId[] = $resource_id;
        }

        //  echo Dumper::dump($resource_id);
       
        $qb = $this->em->createQueryBuilder();
        $qb->select('location.latitude, location.longitude, location.address, location.notFound')
            ->distinct()    
            ->from('BuMaps\Entity\BuMapsLocations', 'location')
            ->leftJoin('BuMaps\Entity\BuMapsResourcesLocations', 'r', 'WITH', 'location.id = r.location')
            ->where('r.resource IN ('.implode(',', $itemsId). ') AND location.notFound = 0');

        $query = $qb->getQuery();
        $coordinates = $query->getResult();
        
        return $coordinates;
    }

    
}
