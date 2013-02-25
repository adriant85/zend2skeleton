<?php

namespace Transaction;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
//use Transaction\Model\Transaction;
//use Transaction\Model\PhotoMapper;

use Zend\EventManager\EventManager;
use Zend\EventManager\Event;

//use Zend\Log\Factory as LogFactory;

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
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
//        echo '<br />trigger onDispatch event<br />';
//        var_dump($e->getApplication());
    }
    public function onBootstrap(\Zend\Mvc\MvcEvent $e) {
//        $param = "parameter 1";
//        $t = new Transaction();
//        $t->getEventManager()->attach('bar', function(Event $e) use ($param){
//            echo 'bar event is triggered; This is param: '.$param;
//        });
//        $log = new PhotoMapper();
//        $log->events()->attach('findById.pre', function(Event $event) {
//            $message = "Trying to retrieve photo: " . $event->getParam('id');
//            echo $message;
//        });
//        $log->events()->attach('findById.post', function(Event $event) {
//            $message = "Retrieved photo: " . $event->getParam('photo').' in '.$event->getName().' method from class '.get_class($event->getTarget());
//            echo $message;
//        });
//        $log->findById('3');
//        
//        $em = $e->getApplication()->getEventManager();
//        $em->attach(\Zend\Mvc\MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'));
//        $t->bar('param2','param3');
    }
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getControllerConfig() {
        return array(
            'factories' => array(
                'Transaction\Controller\Transaction' => function ($sm) {
                    //$transaction = new Transaction();
                    $pm = $sm->getServiceLocator()->get('PhotoMapper');
                    $t = $sm->getServiceLocator()->get('Transaction');
//                    $pm = new PhotoMapper();
                    $pm->attachEvents();
                    $controller = new Controller\TransactionController($t, $pm);
                    return $controller;
                },
                
            ),
        );
    }
    public function getServiceConfig() {
        return array(
            'invokables' => array(
                'PhotoMapper' => 'Transaction\Model\PhotoMapper'
            ),
            'factories' => array(
                'TransactionFactory' => function ($sm) {
                    $factory = new Model\TransactionFactory();
                    $factory->setInvokableClass('SubTransaction','Transaction\Model\Subtransaction', false);
                    return $factory;
                },
                'Transaction' => function ($sm) {
                    $pluginManager = $sm->get('TransactionFactory');
                    $transaction = new Model\Transaction($pluginManager);
                    return $transaction;
                }        
            ),
        );
    }
}