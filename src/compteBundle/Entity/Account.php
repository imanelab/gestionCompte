<?php

namespace compteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="compteBundle\Repository\AccountRepository")
 */
class Account
{

    /**

   * @ORM\OneToOne(targetEntity="compteBundle\Entity\Delegation")

   * @ORM\JoinColumn(nullable=true)

   */

  private $delagation;

    /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Account")

   * @ORM\JoinColumn(nullable=false)

   */

  private $account;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="rib", type="bigint", unique=true)
     */
    private $rib;

    /**
     * @var int
     *
     * @ORM\Column(name="depth", type="integer")
     */
    private $depth;

    /**
     * @var float
     *
     * @ORM\Column(name="balance", type="float", nullable=true)
     */
    private $balance;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rib
     *
     * @param integer $rib
     * @return Account
     */
    public function setRib($rib)
    {
        $this->rib = $rib;

        return $this;
    }

    /**
     * Get rib
     *
     * @return integer 
     */
    public function getRib()
    {
        return $this->rib;
    }

    /**
     * Set depth
     *
     * @param integer $depth
     * @return Account
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * Get depth
     *
     * @return integer 
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Set balance
     *
     * @param float $balance
     * @return Account
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float 
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set delagation
     *
     * @param \compteBundle\Entity\Delagation $delagation
     * @return Account
     */
    public function setDelagation(\compteBundle\Entity\Delagation $delagation)
    {
        $this->delagation = $delagation;

        return $this;
    }

    /**
     * Get delagation
     *
     * @return \compteBundle\Entity\Delagation 
     */
    public function getDelagation()
    {
        return $this->delagation;
    }

    /**
     * Set account
     *
     * @param \compteBundle\Entity\Account $account
     * @return Account
     */
    public function setAccount(\compteBundle\Entity\Account $account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \compteBundle\Entity\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }
}
