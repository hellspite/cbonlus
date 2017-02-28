<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Equipe;

/**
 * EquipeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EquipeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getByName(){
        $query = $this->createQueryBuilder('e')
            ->orderBy('e.name', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
}
