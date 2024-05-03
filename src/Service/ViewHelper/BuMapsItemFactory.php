<?php
namespace BuMaps\Service\ViewHelper;

use BuMaps\ViewHelper\BuMapsItem;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class BuMapsItemFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $apiService = $services->get('Omeka\ApiManager');
        $logger = $services->get('Omeka\Logger');
        $requests = $services->get('BuMapsRequests');
        
        return new BuMapsItem($apiService, $logger, $requests);
    }
}