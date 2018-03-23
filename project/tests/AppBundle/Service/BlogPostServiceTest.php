<?php

namespace AppBundle\Service;

use AppBundle\Service\BlogPostService;
use AppBundle\Entity\BlogPost;
use AppBundle\Repository\BlogPostRepository;
use AppBundle\Service\Exception\ConnectivityException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\DBALException;
use Prophecy\Argument;
use PHPUnit\Framework\TestCase;

class BlogPostServiceTest extends TestCase
{
    private $entityManager;
    
    private $BlogPostService;
    
    private $repository;
    
    public function setUp()
    {
        $this->entityManager = $this->prophesize(EntityManagerInterface::class);
        $this->repository = $this->prophesize(BlogPostRepository::class);
        $this->entityManager->getRepository(Argument::exact('AppBundle:BlogPost'))
            ->willReturn($this->repository->reveal());
        
        $this->BlogPostService = new BlogPostService($this->entityManager->reveal());
    }
    
    public function testFetchAllPosts()
    {
        $posts = [
            new BlogPost(),
            new BlogPost()
        ];
        
        $this->repository->findAll()->willReturn($posts);
        
        $result = $this->BlogPostService->fetchAllPosts();
        
        $this->assertInternalType('array', $result);
        $this->assertCount(2, $result);
        $this->assertSame($posts, $result);
    }
    
    public function testFetchAllPostsGoneWrong()
    {
        $this->setExpectedException(ConnectivityException::class);
        $this->repository->findAll()->willThrow(new DBALException, 'Test');
        $this->BlogPostService->fetchAllPosts();
    }
}