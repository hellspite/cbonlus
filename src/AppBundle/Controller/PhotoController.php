<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PhotoController extends Controller
{
    /**
     * @Route("/foto")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Photo:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/album")
     */
    public function albumAction()
    {
        return $this->render('AppBundle:Photo:album.html.twig', array(
            // ...
        ));
    }

}
