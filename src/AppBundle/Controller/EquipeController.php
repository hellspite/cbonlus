<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EquipeController extends Controller
{
    /**
     * @Route("/equipe")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Equipe:index.html.twig', array(
            // ...
        ));
    }

}
