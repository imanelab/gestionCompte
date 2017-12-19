<?php

namespace compteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ParagraphRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParagraphRepository extends EntityRepository
{

		public function getParagraphsByMorass($morass)
  {

    $qb = $this->createQueryBuilder('p');
    $qb->join('p.morass', 'm')
       ->where($qb->expr()->eq('m.id', $morass->getId()));
    return $qb;
  }
}
