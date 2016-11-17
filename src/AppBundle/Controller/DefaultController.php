<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/presentazione", name="mission")
     */
    public function missionAction(Request $request){
        return $this->render('default/mission.html.twig');
    }

    /**
     * @Route("/contatti", name="contact")
     */
    public function contactAction(Request $request){
        return $this->render('default/contact.html.twig');
    }
}
