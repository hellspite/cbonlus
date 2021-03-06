<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VideoFrontController extends Controller
{
    /**
     * @Route("/video", name="video")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $videos = $em->getRepository('AppBundle:Video')->getOrderedByCreatedAt();

        return $this->render('AppBundle:Video:index.html.twig', array(
            'videos' => $videos
        ));
    }

}
