<?php 

namespace Transaction\Model;

use Zend\EventManager\EventManager;
use Zend\EventManager\Event;
 
class PhotoMapper
{
    public $events;
    protected $currentId;
 
    public function events() 
    {
        if (!$this->events) {
            $this->events = new EventManager(__CLASS__); 
        }
 
        return $this->events;
    }
 
    public function findById($id = "1")
    {
        $this->currentId = $id;
        $this->events()->trigger(__FUNCTION__ . '.pre', $this,
            array('id' => $id));
 
        // retrieve from database and create a $photo entity object
        $array = array ('1' => 'photo1', '2' => 'photo2', '3' => 'photo3', '4' => 'photo4', '5' => 'photo5');
 
        $this->events()->trigger(__FUNCTION__ . '.post', $this, 
            array('photo' => $array[$id]));
 
        return $array[$id];
    }
    
    public function getCurrentId() {
        return $this->currentId;
    }
    
    public function attachEvents() {
        $this->events()->attach('findById.pre', function(Event $event) {
            $message = "<br />Trying to retrieve photo: " . $event->getParam('id');
            echo $message;
        });
        $this->events()->attach('findById.post', function(Event $event) {
            $message = "<br />Retrieved photo: " . $event->getParam('photo').' in '.$event->getName().' method from class '.get_class($event->getTarget());
            echo $message;
        });        
    }
}