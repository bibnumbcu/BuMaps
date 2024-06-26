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

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class BuMapsRequestsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // $itemSetsTree = new ItemSetsTree();
        // $itemSetsTree->setApiManager($container->get('Omeka\ApiManager'));
        // $itemSetsTree->setEntityManager($container->get('Omeka\EntityManager'));
        // $itemSetsTree->setApiAdapterManager($container->get('Omeka\ApiAdapterManager'));

        $requests = new BuMapsRequests();
        $requests->setEntityManager($container->get('Omeka\ApiManager'), $container->get('Omeka\EntityManager'));
        
        return $requests;
    }
}
