<?php

namespace Building; 
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;


class Module implements AutoloaderProviderInterface {
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getControllerConfig()
    {   
        return array('factories' => array(
            'Building\Controller\Building' => function ($sm)
            {   
                $building = $sm->getServiceLocator()->get('Building');
                $view = $sm->getServiceLocator()->get('ViewFactory');
                $controller = new Controller\BuildingController($building ,$view);
                return $controller;
            }   
        )); 
    } 
    public function getServiceConfig()
    {   
        return array(
            'factories' => array(
                'ViewFactory' => function($sm) {       
                    $viewFactory = new Model\ViewFactory();
                    $viewFactory->setInvokableClass('ViewModel', 'Zend\View\Model\ViewModel');
                    return $viewFactory;
                },     
                'BrickFactory' => function($sm) {       
                    $brickFactory = new Model\BrickFactory();
                    $brickFactory->setInvokableClass('Brick', 'Building\Model\Brick', false);
                   return $brickFactory;
                },     
                'Building' => function($sm) {       
                    $pluginManager = $sm->get('BrickFactory');
                    $building = new Model\Building($pluginManager);
                    return $building;
                },                  
            ),
        ); 
    }    
}