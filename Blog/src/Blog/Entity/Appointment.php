<?php

namespace Blog\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $time;

    public function getId()
    {
    return $this->id;
    }

    public function setTime(DateTime $time)
    {
        $this->time = $time;
    }

    public function getTime()
    {
        return $this->time;
    }
}