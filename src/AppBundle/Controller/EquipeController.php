<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EquipeController extends Controller
{
    /**
     * @Route("/equipe", name="equipe")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipe = $em->getRepository('AppBundle:Equipe')->findAll();

        return $this->render('AppBundle:Equipe:index.html.twig', array(
            'equipe' => $equipe
        ));
    }

}
