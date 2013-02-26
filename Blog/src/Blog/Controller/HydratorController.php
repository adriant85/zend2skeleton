<?php

namespace Blog\Controller;

use Blog\Controller\MyEntityController;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use Blog\Entity\City;
use Blog\Entity\Appointment;
use Blog\Entity\User;
use Blog\Entity\BlogPost;
use Blog\Entity\Tag;

class HydratorController extends MyEntityController {
    
    public function __construct() {
    }
    
    public function indexAction() {
        $hydrator = new DoctrineHydrator($this->getEntityManager(), 'Blog\Entity\City');
        $city = new City();
        $data = array(
            'name' => 'Cluj-Napoca'
        );
        $city = $hydrator->hydrate($data, $city);
        echo $city->getName();
        $data = $hydrator->extract($city);
        var_dump($data['name']);
        
        $hydrator = new DoctrineHydrator($this->getEntityManager(), 'Blog\Entity\Appointment');
        $appointment = new Appointment();
        $data = array(
            'time' => '2012-09-23' //Y-m-d
        );

        $appointment = $hydrator->hydrate($data, $appointment);

        echo get_class($appointment->getTime());
        var_dump($appointment->getTime());
        
        $hydrator = new DoctrineHydrator($this->getEntityManager(), 'Blog\Entity\BlogPost');
        $blogPost = new BlogPost();
        
        $user = new User();
        $user->setUsername('adrian');
        $user->setPassword('parola');
        
        $data = array(
            'title' => 'This is a title',
            'user' => $user
        );
        $hydrator->hydrate($data, $blogPost);
        echo "username: ".$blogPost->getUser()->getUsername();
        var_dump($blogPost);
        
        $hydrator = new DoctrineHydrator($this->getEntityManager(), 'Blog\Entity\BlogPost');
        $blogPost = new BlogPost();
        
        /* same hydration with an already existing user  */
        $data = array(
            'title' => 'This is a title',
            'user' => array(
                'id' => '2'
            )
        );
        
        $hydrator->hydrate($data, $blogPost);
        echo $blogPost->getUser()->getId();
        var_dump($blogPost);
        
        $hydrator = new DoctrineHydrator($this->getEntityManager(), 'Blog\Entity\BlogPost');

//        $data = array(
//            'title' => 'This is a blogpost title',
//            'tags' => array(
//                array('id' => '2'),
//                array('id' => '3')
//            ),
//        );
        /* alternative way to hydrate data */        
        $data = array(
            'title' => 'This is a blogpost title',
            'tags' => array(
                array('2', '3')
            ),
        );        
        $blogPost = new BlogPost();
        $blogPost = $hydrator->hydrate($data, $blogPost);
        
        echo $blogPost->getTitle();
        var_dump(count($blogPost->getTags()));
    }
    
}
