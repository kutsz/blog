<?php

namespace AppBundle\Repository;

/**
 * HomeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HomeRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllTitle(){
        return $this->getEntityManager()->createQuery(
                'SELECT title FROM AppBundle:Home title')
                ->getResult();
    }
}
