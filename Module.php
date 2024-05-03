<?php
namespace BuMaps;

use Omeka\Module\AbstractModule;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractController;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Zend\EventManager\Event;
use Zend\EventManager\SharedEventManagerInterface;

class Module extends AbstractModule
{
    /** Module body **/

    /**
     * Get this module's configuration array.
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function install(ServiceLocatorInterface $services)
    {
        $connection = $services->get('Omeka\Connection');
  
        $connection->exec('CREATE TABLE IF NOT EXISTS bu_maps_locations (id INT AUTO_INCREMENT NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, address VARCHAR(255) DEFAULT NULL, not_found INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $connection->exec('CREATE TABLE IF NOT EXISTS bu_maps_resources_locations (id INT AUTO_INCREMENT NOT NULL, resource_id INT NOT NULL, location_id INT NOT NULL, INDEX IDX_F75DCAFF89329D25 (resource_id), INDEX IDX_F75DCAFF64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $connection->exec('ALTER TABLE bu_maps_resources_locations ADD CONSTRAINT FK_F75DCAFF89329D25 FOREIGN KEY IF NOT EXISTS (resource_id) REFERENCES resource (id) ON DELETE CASCADE;');
        $connection->exec('ALTER TABLE bu_maps_resources_locations ADD CONSTRAINT FK_F75DCAFF64D218E FOREIGN KEY IF NOT EXISTS (location_id) REFERENCES bu_maps_locations (id) ON DELETE CASCADE;');
  
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $sharedEventManager->attach(
            'Omeka\Controller\Site\Item',
            'view.show.before',
            [$this, 'addLeaflet']
            
        );

        $sharedEventManager->attach(
            'Omeka\Controller\Site\Item',
            'view.browse.before',
            [$this, 'addLeaflet']
            
        );
    }

    public function addLeaflet($event)
    {
        $view = $event->getTarget();
        $assetUrl = $view->plugin('assetUrl');
        $view->headLink()->appendStylesheet($assetUrl('css/leaflet.css', 'BuMaps'));
        $view->headScript()->appendFile($assetUrl('js/leaflet.js', 'BuMaps'));
    }
}