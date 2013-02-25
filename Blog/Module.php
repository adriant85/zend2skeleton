<?php
namespace Blog;

class Module
{
  public function getConfig()
  {
    return include __DIR__ . '/config/module.config.php';
  }

  public function getAutoloaderConfig()
  {
    return array(
      'Zend\Loader\StandardAutoloader' => array(
        'namespaces' => array(
          __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
        ),
      ),
    );
  }
  public function getServiceConfig() {
      return array(
          'factories' => array(
              //can set the entity manager available in all modules
              //create a special entity class in /Service/EntityManagerHandling.class and instantiate it here
          )
      );
  }
}