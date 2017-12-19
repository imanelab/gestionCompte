<?php

namespace compteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Account
 *
 * @Gedmo\Loggable
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="compteBundle\Repository\AccountRepository")
 */
class Account
{

    /**

   * @ORM\OneToOne(targetEntity="compteBundle\Entity\Delegation")

   * @ORM\JoinColumn(nullable=true)

   */

  private $delegation;

    /**

   * @ORM\ManyToOne(targetEntity="CUserBundle\Entity\User")

   * @ORM\JoinColumn(nullable=true)

   */

  private $user;

    /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Account")

   * @ORM\JoinColumn(nullable=true)

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
     * @Gedmo\Versioned
     * @ORM\Column(name="rib", type="bigint", unique=true)
     */
    private $rib;

    /**
     * @var string
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="account_name", type="string", nullable=true,length=255)
     */
    private $accountName;

    /**
     * @var int
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="depth", type="integer")
     */
    private $depth;

    /**
     * @var float
     *
     * @Gedmo\Versioned
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
     * Set delegation
     *
     * @param \compteBundle\Entity\Delegation $delegation
     * @return Account
     */
    public function setDelegation(\compteBundle\Entity\Delegation $delegation)
    {
        $this->delegation = $delegation;

        return $this;
    }

    /**
     * Get delegation
     *
     * @return \compteBundle\Entity\Delegation 
     */
    public function getDelegation()
    {
        return $this->delegation;
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


    public function removeParent()
    {
        unset($this->account);
    }

    /**
     * Set accountName
     *
     * @return Account
     */
    public function setAccountName()
    {
        if( $this->delegation)
        $this->creditAccountName = $this->delegation->getName();
        else
        $this->creditAccountName = "الحساب المركزي:".$this->rib;

        return $this;
    }

    /**
     * Get accountName
     *
     * @return string 
     */
    public function getAccountName()
    {
        if($this->accountName)
        return $this->accountName;
    elseif( $this->delegation)
        return $this->delegation->getName();
    else
        return "الحساب المركزي:".$this->rib;
    }

    /**
     * Set user
     *
     * @param \CUserBundle\Entity\User $user
     * @return Account
     */
    public function setUser(\CUserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CUserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
