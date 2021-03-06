<?php

namespace AppBundle\Repository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
    public function orderedByDate($max = null){
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.date', 'DESC')
            ->setMaxResults($max)
            ->getQuery();

        return $query->getResult();
    }
}
