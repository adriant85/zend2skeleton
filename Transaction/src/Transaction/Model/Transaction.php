<?php
namespace Transaction\Model;

use Zend\Form\Annotation;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;

class Transaction implements EventManagerAwareInterface{
    protected $events;
    protected $subTransactions;
    public $tFactory;
    
    public $transactionTypes = array('income','expense');    
    private static $transId = 0;
    
    public function __construct(TransactionFactory $tFactory) {
        $this->subTransactions = array();
        $this->tFactory = $tFactory;
    }
    
    public function setEventManager(EventManagerInterface $events) {
        $events->setIdentifiers(array(
            __CLASS__,
            get_called_class(),
        ));
        $this->events = $events;
        return $this;
    }

    public function getEventManager() {
        if (null === $this->events) {
            $this->setEventManager(new EventManager());
        }
        return $this->events;
    }
    
    public function bar($baz, $bat = null) {
       $params = compact('baz', 'bat');
       $this->getEventManager()->trigger(__FUNCTION__, $this, $params);
    }
    
    public function createSubTransaction($tDetail) {
        $subTransaction = $this->tFactory->get('SubTransaction', $tDetail);
        return $subTransaction;
    }
    
    private function generateRandomData() {
        return array(
            'id' => ++Transaction::$transId,
            'type' => $this->transactionTypes[rand(1, 2) - 1],
            'date' => date('Y-m-d'),
            'value' => rand(1, 100),
        );
    }
    public function addSubTransactions() {
        $randTrans = rand(1,3);
        for ($i = 0; $i < $randTrans; $i++) {
            $this->subTransactions[] = $this->createSubTransaction($this->generateRandomData());
        }
    }
    
    public function getSubTransactions() {
        return $this->subTransactions;
    }  
}