<?php

namespace AppBundle\Repository;

/**
 * PhotoAlbumRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PhotoAlbumRepository extends \Doctrine\ORM\EntityRepository
{
    public function orderedByCreation(){
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery();

        return $query->getResult();
    }
}
