<?php
/**
 * Created by PhpStorm.
 * User: Lenovo2018
 * Date: 14/12/2018
 * Time: 11:07
 */

namespace AppBundle\Repository;


class UserRepository extends \Doctrine\ORM\EntityRepository



{



    /**
     * @param string $role
     *
     * @return array
     */
    public function findByRole($role)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from($this->_entityName, 'u')
            ->where('u.roles LIKE :roles')
            ->setParameter('roles', '%"'.$role.'"%');

        return $qb->getQuery()->getResult();
    }
}