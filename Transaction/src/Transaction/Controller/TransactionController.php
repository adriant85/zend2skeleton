<?php

namespace Transaction\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Transaction\Model\PhotoMapper;
use Transaction\Model\Transaction;

class TransactionController extends AbstractActionController {
    protected $photoMapper;
    protected $transactions;
    
    public function __construct(Transaction $trans, PhotoMapper $photoMapper) {
        $this->photoMapper = $photoMapper;
        $this->transactions = $trans;
    }
    
    public function indexAction() {
//        $this->photoMapper->findById('5');
        $this->transactions->addSubTransactions();
        $this->transactions->addSubTransactions();
        
        $view = new ViewModel();
        $view->setVariables(array(
            'transactions' => $this->transactions,
//            'mapperId' => $this->photoMapper->getCurrentId(),
        ));
        return $view;
    } 
}