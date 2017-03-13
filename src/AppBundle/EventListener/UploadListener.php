<?php

namespace AppBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Oneup\UploaderBundle\Event\PostPersistEvent;
use Symfony\Component\HttpFoundation\File\File;
use AppBundle\Entity\Photo;
use AppBundle\Entity\PhotoAlbum;

class UploadListener{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function onUpload(PostPersistEvent $event)
    {
        $file = $event->getFile()->getFilename();
        $request = $event->getRequest();
        $albumId = $request->get('album');

        $album = $this->em->getRepository('AppBundle:PhotoAlbum')->find($albumId);
        $photo = New Photo();
        $photo->setImage($file);
        $photo->setAlbum($album);
        $photo->setUpdatedAt(new \DateTime());

        $this->em->persist($photo);
        $this->em->flush($photo);

        $response = $event->getResponse();
        $response['success'] = true;
        return $response;
    }
}
