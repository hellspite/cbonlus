<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ServiceController extends Controller
{
    /**
     * @Route("servizi-integrativi")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Service:index.html.twig', array(
            // ...
        ));
    }

}
