<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EventController extends Controller
{
    /**
     * @Route("/eventi")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Event:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/evento")
     */
    public function showAction()
    {
        return $this->render('AppBundle:Event:show.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/eventi-passati")
     */
    public function pastAction()
    {
        return $this->render('AppBundle:Event:past.html.twig', array(
            // ...
        ));
    }

}
