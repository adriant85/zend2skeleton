<?php
namespace Album\Form;

use Zend\Form\Form;
use Zend\EventManager\EventManager;
use Zend\EventManager\Event;
use Album\Listener\Logging;

class AlbumForm extends Form
{
    protected $events = null;
    protected $logger = null;
    public function events() {
        if ($this->events === null) {
            $this->events = new EventManager(__CLASS__);
            $logListener = new Logging();
            $this->events->attach(
                    'isValid.pre', 
                    array($logListener, 'logOutput')
            );
            $this->events->attach(
                    'isValid.post',
                    array($logListener, 'logOutput')
            );
        }
        return $this->events;
    }
    
    public function isValid() {
        
        $this->events()->trigger(__FUNCTION__.'.pre', $this, $this->data);
        $isValid = parent::isValid();
        $this->data['isValid'] = $isValid;
        $this->events()->trigger(__FUNCTION__.'.post', $this, $this->data);
        return $isValid;
    }
    
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('album');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'artist',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Artist',
            ),
        ));
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}