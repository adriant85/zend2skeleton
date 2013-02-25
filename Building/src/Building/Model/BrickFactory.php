<?php
namespace Building\Model;

use Zend\ServiceManager\AbstractPluginManager;

class BrickFactory extends AbstractPluginManager
{
    public function validatePlugin($plugin)
    { 
        if ($plugin instanceof Brick)  
        {       
            return; 
        }       
        throw new \DomainException('Invalid Brick Implementation');
    }

}