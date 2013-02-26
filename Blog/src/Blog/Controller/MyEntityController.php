<?php

namespace Blog\Controller;
use Doctrine\ORM\EntityManager;
use \Zend\Mvc\Controller\AbstractActionController;

class MyEntityController extends AbstractActionController {
    protected $entityManager;
    public function __construct() {
        
    }
    protected function setEntityManager(EntityManager $em) {
        $this->entityManager = $em;
    }
    protected function getEntityManager() {
        if (null === $this->entityManager) {
            $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        }
        return $this->entityManager;
    }
}