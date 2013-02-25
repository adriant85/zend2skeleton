<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Album\Controller\Album' => 'Album\Controller\AlbumController',
            'Album\Controller\Auth' => 'Album\Controller\AuthController',
            'Album\Controller\Success' => 'Album\Controller\SuccessController',
            'Album\Controller\Testcaptcha' => 'Album\Controller\TestcaptchaController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'testcaptcha' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/test',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Album\Controller',
                        'controller'    => 'Testcaptcha',
                        'action'        => 'form',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'captcha_form' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/[:controller[/[:action[/]]]]',
                             'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),                
                ),  
                'captcha_form_generate' => array(
                    'type'    => 'segment',
                    'options' => array(
                        'route'    =>  '/[:controller[/generate/[:id]]]',
                         'constraints' => array(
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        ),
                        'defaults' => array(
                            'controller' => 'testcaptcha',
                            'action'     => 'generate',
                         ),
                    ),
                ),                
            ),  

            'album' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/album[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Album\Controller\Album',
                        'action'     => 'index',
                    ),
                ),
            ),
            'login' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/login',
                    'may_terminate' => true,
                    'defaults' => array(
                        '__NAMESPACE__' => 'Album\Controller',
                        'controller' => 'Auth',
                        'action'    => 'login'
                    ),
                ),
            ),
            
            'auth' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Album\Controller',
                        'controller' => 'Auth',
                        'action'    => 'authenticate'
                    ),
                    'may_terminate' => true,
                ),
            ),
            'logout' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/logout',
                    'may_terminate' => true,
                    'defaults' => array(
                        '__NAMESPACE__' => 'Album\Controller',
                        'controller' => 'Auth',
                        'action'    => 'logout'
                    ),
                ),
            ),            
            'success' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/success',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Album\Controller',
                        'controller'    => 'Success',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',            
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