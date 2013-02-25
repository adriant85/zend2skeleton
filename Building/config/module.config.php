<?php

return array(
    'controllers' => array(
        'invokables' => array(
//            'Building\Controller\Building' => 'Building\Controller\BuildingController'
        )
    ),
    'router' => array(
        'routes' => array(
            'building' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/building',
                    'defaults' => array(
                        'controller' => 'Building\Controller\Building',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),        
    )
);