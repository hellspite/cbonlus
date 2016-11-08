<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Post;

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
     * @Route("/blog/post/{id}", name="news_show")
     */
    public function showAction(Post $post)
    {

        return $this->render('AppBundle:News:show.html.twig', array(
            'post' => $post
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
