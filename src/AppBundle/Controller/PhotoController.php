<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\Common\Collections\ArrayCollection;

class PhotoController extends Controller
{
    /**
     * @Route("/album-foto", name="photo_album")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository('AppBundle:PhotoAlbum')->orderedByCreation();


        return $this->render('AppBundle:Photo:index.html.twig', array(
            'albums' => $albums,
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
