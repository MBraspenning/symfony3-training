<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;
    
    /**
    * @var BlogPost
    *
    * @ORM\ManyToOne(targetEntity="BlogPost", inversedBy="comments")
    * @ORM\JoinColumn(name="blogpost_id", referencedColumnName="id")
    */
    private $blogpost;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Comment
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
    
    /**
    * Set blogpost
    *
    * @return BlogPost
    */
    public function setBlogpost($blogpost)
    {
        $this->blogpost = $blogpost;
        
        return $this;
    }
    
    /**
    * Get blogpost
    *
    * @return BlogPost
    */
    public function getBlogpost()
    {
        return $this->blogpost;
    }
}

