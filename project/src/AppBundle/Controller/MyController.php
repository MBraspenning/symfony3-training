<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MyController extends Controller
{
    /**
     * @Route("/hobby/{hobby}", name="hobby_page")
     */
    public function hobbyAction(Request $request, $hobby)
    {
        return $this->render('default/'.$hobby.'.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'hobby' => $hobby,
        ]);
    }
}
