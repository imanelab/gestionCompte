<?php

namespace compteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * LineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LineRepository extends EntityRepository
{

	public function getMasterEntities($id)
  {
    $qb = $this->createQueryBuilder('l');
    $qb->join('l.masterEntities', 'f')
       ->where($qb->expr()->eq('f.id', $id));
    return $qb;
  }


  	public function getLinesByMasterEntitiesId($user)
  {
  	$masterEntity= $user->getMasterEntity();

    $qb = $this->createQueryBuilder('l');
    $qb->join('l.masterEntities', 'f')
       ->where($qb->expr()->eq('f.id', $masterEntity->getId()));
    return $qb;
  }
}
