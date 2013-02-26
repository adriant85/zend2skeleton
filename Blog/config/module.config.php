<?php
namespace Blog;

return array(
  'router' => array(
    'routes' => array(
      'post' => array(
        'type' => 'segment',
        'options' => array(
          'route' => '/post[/:action][/:id]',
          'constraints' => array(
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]+',
          ),
          'defaults' => array(
            'controller' => 'Blog\Controller\Post',
            'action' => 'index',
          ),
        ),
      ),
      'hydrator' => array(
          'type' => 'Literal',
          'options' => array(
            'route' => '/hydrator',
            'defaults' => array(
                '__NAMESPACE__' => 'Blog\Controller',
                'controller' => 'Blog\Controller\Hydrator',
                'action' => 'index'
            ),              
          ),
      ),  
    ),
  ),
  'controllers' => array(
    'invokables' => array(
      'Blog\Controller\Post' => 'Blog\Controller\PostController',
      'Blog\Controller\Hydrator' => 'Blog\Controller\HydratorController'
    ),
  ),
  'view_manager' => array(
    'template_path_stack' => array(
      'blog' => __DIR__ . '/../view',
    ),
  ),
    'doctrine' => array(
        'driver' => array(
          __NAMESPACE__ . '_driver' => array(
            'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
            'cache' => 'array',
            'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
          ),
          'orm_default' => array(
            'drivers' => array(
              __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
            )
          )
        )
      )
);