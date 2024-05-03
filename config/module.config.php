<?php
namespace BuMaps;


return [
    'view_manager' => [
        'template_path_stack' => [
            OMEKA_PATH.'/modules/BuMaps/view',
        ],
    ],
    'controllers' => [
        'invokables' => [
            'BuMaps\Controller\Site\Index' => 'BuMaps\Controller\Site\IndexController',
        ],
    ],
    'entity_manager' => [
        'mapping_classes_paths' => [
            dirname(__DIR__) . '/src/Entity',
        ],
        'proxy_paths' => [
            dirname(__DIR__) . '/data/doctrine-proxies',
        ],
    ],
    'view_helpers' => [
        'factories'  => [
            'BuMapsItem' => 'BuMaps\Service\ViewHelper\BuMapsItemFactory',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'BuMapsRequests' => 'BuMaps\Service\BuMapsRequestsFactory',
        ],
    ],
];
