<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\BlogPost;

class BlogPostService
{
    protected $repository;
    protected $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository('AppBundle:BlogPost');
        $this->entityManager = $entityManager;
    }
    
    public function fetchAllPosts()
    {
        return $this->repository->findAll();
    }
    
    public function fetchAllPostsForLastWeek()
    {
        return $this->repository->fetchPostsForLastWeek();
    }
    
    public function persist(BlogPost $BlogPost)
    {
        $this->entityManager->persist($BlogPost);
        $this->entityManager->flush();
    }
    
    
}
