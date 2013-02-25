<?php
namespace Transaction\Model;

use Zend\ServiceManager\AbstractPluginManager;

class TransactionFactory extends AbstractPluginManager {
    //needs just one function
    public function validatePlugin($plugin) {
        if ($plugin instanceof SubTransaction) {
            return;
        }
        throw new \DomainException('Invalid SubTransaction implementation');
    }
}