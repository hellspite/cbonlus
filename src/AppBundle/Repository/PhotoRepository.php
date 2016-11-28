<?php

namespace AppBundle\Repository;

use AppBundle\Entity\PhotoAlbum;

/**
 * PhotoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PhotoRepository extends \Doctrine\ORM\EntityRepository
{
    public function getByAlbum(PhotoAlbum $album){
        $query = $this->createQueryBuilder('p')
            ->where('p.album = :album')        
            ->setParameter('album', $album->getId())
            ->getQuery();

        return $query->getResult();
    }

    public function getOrderedByUpdate(){
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.updatedAt', 'DESC')
            ->getQuery();

        return $query->getResult();
    }
}
