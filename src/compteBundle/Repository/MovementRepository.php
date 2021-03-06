<?php

namespace compteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * MovementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MovementRepository extends EntityRepository
{


//get all account transactions debit+credit and sort by date

	public function getAccountTransactions($account){

		$qb = $this->createQueryBuilder('m');
			  $qb->where('m.debitAccount= :debitAccount')
			  ->orWhere('m.creditAccount= :creditAccount')
			  ->setParameters(['debitAccount'=>$account->getId(),'creditAccount'=>$account->getId()])
			  ->orderBy('m.realDateMv, m.id');
			  return $qb;
	}

//get all movements of a masterEntity that require validation

	public function getToApproveByMasterEntity($masterEntity){

		$qb = $this->createQueryBuilder('m');
			  $qb->where('m.user.id= :masterEntity')
			  ->setParameters(['masterEntity'=>$masterEntity])
			  ->orderBy('m.realDateMv, m.id');
			  return $qb;
	}
}
