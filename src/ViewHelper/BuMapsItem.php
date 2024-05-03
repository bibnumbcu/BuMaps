<?php 
namespace BuMaps\ViewHelper;

use Laminas\View\Helper\AbstractHelper;
use Zend\View\HelperPluginManager as ServiceManager;

use Doctrine\DBAL\Tools\Dumper;

class BuMapsItem extends AbstractHelper
{
    protected $apiServices;
    protected $logger;
    protected $buMapsRequests;

    public function __construct($apiServices, $logger, $buMapsRequests)
    {
        $this->apiServices = $apiServices;
        $this->logger = $logger;
        $this->buMapsRequests = $buMapsRequests;
    }

    public function __invoke($type='Item', $resource=null) 
    {
        if (!$resource)
            return '';
        
        $view = $this->getView();
        
        if ($type=='Item'){
            $coordinates = $this->buMapsRequests->getCoordinates('Item', $resource->id());
        }
        else if ($type=='ItemSet'){
            $coordinates = $this->buMapsRequests->getCoordinates('ItemSet', $resource->id());
        }
        
        // echo Dumper::dump($coordinates);
        
        return $this->getView()->partial(
            'common/bu-maps-item-helper.phtml',
            [
                'coordinates' => $coordinates,
            ]
        );
    }
}