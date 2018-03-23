<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    private $comment;
    
    public function setUp()
    {
        $this->comment = new Comment();
    }
    
    public function testGettersAndSetters()
    {
        $this->comment->setAuthor('schrijver');
        $this->comment->setBody('Body content');
        
        $this->assertSame('schrijver', $this->comment->getAuthor());
        $this->assertSame('Body content', $this->comment->getBody());
    }
    
    public function testDefaultDate()
    {
    }
}
