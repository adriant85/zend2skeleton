<?php
return array(
    'controllers' => array(
        'invokables' => array(
            //'Transaction\Controller\Transaction' => 'Transaction\Controller\TransactionController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'transaction' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/transact',                    
                    'defaults' => array(
                        'controller' => 'Transaction\Controller\Transaction',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'transaction' => __DIR__ . '/../view',
        ),   
    ),
);