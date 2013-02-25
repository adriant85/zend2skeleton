<?php

namespace Transaction\Model;

class SubTransaction {

    protected $id;
    protected $type;
//    public $category_id;
//    public $currency_id;    
    public $date;
    public $value;
    
    public function __construct($params = array()) {
        if (!is_array($params)) {
            throw new \DomainException('Invalid transaction data provided!');
        }
        foreach ($params as $property => $value) {
            $this->{$property} = $value;
        }
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setType($type) {
        $this->type = $type;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function setDate($date) {
        $this->date = $date;
    }
    
    public function getDate() {
        return $this->date;
    }
    
    public function setValue($value) {
        $this->value = $value;
    }
    
    public function getValue() {
        return $this->value;
    }
    
    public function dump() {
        echo 'TransId: '.$this->getId().' Date:'.$this->getDate().' Type: '.$this->getType().' Value:'.$this->getValue();
    }        
}