<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * @ORM\Entity
 */
class BlogPost
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Blog\Entity\User", cascade={"persist"})
     */
    protected $user;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\OneToMany(targetEntity="Blog\Entity\Tag", mappedBy="blogPost")
     */
    protected $tags;
    
    public function __construct() 
    {
        $this->tags = new ArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }
    
    public function addTags(Collection $tags) {
        foreach ($tags as $tag) {
            $tag->setBlogPost($this);
            $this->tags->add($tag);
        }
    }
    
    public function removeTags(Collection $tags) {
        foreach ($tags as $tag) {
            $tag->setBlogPost(null);
            $this->tags->removeElement($tag);
        }
    }
    
    public function getTags() {
        return $this->tags;
    }
}
