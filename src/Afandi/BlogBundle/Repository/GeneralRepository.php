<?php

namespace Afandi\BlogBundle\Repository;

/**
 * GeneralRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GeneralRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllGeneralPagination()
    {
        $repository = $this->getEntityManager()
            ->getRepository('AfandiBlogBundle:General');
        $query = $repository->createQueryBuilder('generals')
            ->getQuery();

        return $query;
    }

    public function findGeneralValue($name)
    {

        $repository = $this->getEntityManager()
            ->getRepository('AfandiBlogBundle:General');
        $query = $repository->createQueryBuilder('generals')
            ->where('generals.generalName = :name')
            ->setParameter('name', $name)
            ->getQuery();

        $value = $query->setMaxResults(1)->getOneOrNullResult();

        return $value;
    }
}
