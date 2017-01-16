<?php
/**
 * Created by PhpStorm.
 * User: Karim
 * Date: 16/01/2017
 * Time: 18:05
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:User p ORDER BY p.id ASC'
            )
            ->getResult();
    }
}