<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlogPost;
use AppBundle\Entity\Comment;
use AppBundle\Service\BlogPostService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Blogpost controller.
 *
 * @Route("blog-admin")
 */
class BlogPostController extends Controller
{
    private $BlogPostService;
    
    public function __construct(BlogPostService $BlogPostService)
    {
        $this->BlogPostService = $BlogPostService;
    }
    
    /**
     * Lists all blogPost entities.
     *
     * @Route("/", name="blog_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $blogPosts = $em->getRepository('AppBundle:BlogPost')->findAll();
//        foreach($blogPosts as $blogPost) {
//            $deleteForm = $this->createDeleteForm($blogPost);    
//        }

        return $this->render('blogpost/index.html.twig', array(
            'blogPosts' => $blogPosts,
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a new blogPost entity.
     *
     * @Route("/new", name="blog_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {        
        $blogPost = new Blogpost();
        $form = $this->createForm('AppBundle\Form\BlogPostType', $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->BlogPostService->persist($blogPost);

            return $this->redirectToRoute('blog_show', array('id' => $blogPost->getId()));
        }

        return $this->render('blogpost/new.html.twig', array(
            'blogPost' => $blogPost,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a blogPost entity.
     *
     * @Route("/{id}", name="blog_show")
     * @Method("GET")
     */
    public function showAction(BlogPost $blogPost)
    {
        $deleteForm = $this->createDeleteForm($blogPost);
        
        $comments = $blogPost->getComments();

        return $this->render('blogpost/show.html.twig', array(
            'blogPost' => $blogPost,
            'comments' => $comments,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing blogPost entity.
     *
     * @Route("/{id}/edit", name="blog_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BlogPost $blogPost)
    {
        $deleteForm = $this->createDeleteForm($blogPost);
        $editForm = $this->createForm('AppBundle\Form\BlogPostType', $blogPost);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_edit', array('id' => $blogPost->getId()));
        }

        return $this->render('blogpost/edit.html.twig', array(
            'blogPost' => $blogPost,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a blogPost entity.
     *
     * @Route("/{id}", name="blog_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BlogPost $blogPost)
    {
        $form = $this->createDeleteForm($blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($blogPost);
            $em->flush();
        }

        return $this->redirectToRoute('blog_index');
    }

    /**
     * Creates a form to delete a blogPost entity.
     *
     * @param BlogPost $blogPost The blogPost entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BlogPost $blogPost)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blog_delete', array('id' => $blogPost->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
