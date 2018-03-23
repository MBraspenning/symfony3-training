<?php

namespace AppBundle\Entity;

use AppBundle\Entity\BlogPost;
use AppBundle\Entity\Comment;
use PHPUnit\Framework\TestCase;

class BlogPostTest extends TestCase
{
    private $blogpost;
    
    public function setUp()
    {
        $this->blogpost = new BlogPost();
    }
    
    public function testGettersAndSetters()
    {
        $this->blogpost->setPost('This is the body');
        $this->blogpost->setTitle('Title');
        $this->blogpost->setComments([new Comment(), new Comment()]);
        
        $this->assertSame('This is the body', $this->blogpost->getPost());
        $this->assertSame('Title', $this->blogpost->getTitle());
        $this->assertCount(2, $this->blogpost->getComments());
    }
    
    public function testDefaultDateAdded()
    {
        $now = new \DateTime('now');
        $dateString = $now->format('Y-m-d H:i');
        
        $this->assertSame($dateString, $this->blogpost->getDateAdded()->format('Y-m-d H:i'));
    }
}