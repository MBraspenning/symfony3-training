<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlogPost;
use AppBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Blogpost controller.
 *
 * @Route("blog")
 */
class BlogPostPublicController extends Controller
{
    /**
     * Lists all blogPost entities.
     *
     * @Route("/", name="blog_index_public")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $blogPosts = $em->getRepository('AppBundle:BlogPost')->findAll();

        return $this->render('blogpublic/index.html.twig', array(
            'blogPosts' => $blogPosts,
        ));
    }

    /**
     * Finds and displays a blogPost entity.
     *
     * @Route("/{id}", name="blog_show_public")
     * @Method({"GET", "POST"})
     */
    public function showAction(BlogPost $blogPost, Request $request)
    {
        $comments = $blogPost->getComments();
        
        $comment = new Comment();
        $comment->setBlogpost($blogPost);
        $form = $this->createForm('AppBundle\Form\CommentType', $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->render('blogpublic/show.html.twig', array(
                'blogPost' => $blogPost,
                'comments' => $comments,
                'form' => $form->createView(),
            ));
        }
        
        return $this->render('blogpublic/show.html.twig', array(
            'blogPost' => $blogPost,
            'comments' => $comments,
            'form' => $form->createView(),
        ));
    }

}
