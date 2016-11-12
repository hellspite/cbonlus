<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\PhotoAlbum;

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
     * @Route("/album/{id}", name="photos")
     */
    public function albumAction(PhotoAlbum $album)
    {
        $em = $this->getDoctrine()->getManager();

        $photos = $em->getRepository('AppBundle:Photo')->getByAlbum($album);

        return $this->render('AppBundle:Photo:album.html.twig', array(
            'photos' => $photos,
            'album' => $album
        ));
    }

}
