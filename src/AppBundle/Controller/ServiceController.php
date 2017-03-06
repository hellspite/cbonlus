<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Service;

class ServiceController extends Controller
{
    /**
     * @Route("servizi-integrativi", name="service_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $services = $em->getRepository('AppBundle:Service')->findAll();

        return $this->render('AppBundle:Service:index.html.twig', array(
            'services' => $services
        ));
    }

}
