<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NewsController extends Controller
{
    /**
     * @Route("/blog")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:News:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/blog/post")
     */
    public function showAction()
    {
        return $this->render('AppBundle:News:show.html.twig', array(
            // ...
        ));
    }

    public function recentPostAction(){

        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('AppBundle:Post')->orderedByDate(5);

        return $this->render('news/recent.html.twig', array(
            'posts' => $posts        
        ));
    
    }

}
