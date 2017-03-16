<?php

namespace compteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movement
 *
 * @ORM\Table(name="movement")
 * @ORM\Entity(repositoryClass="compteBundle\Repository\MovementRepository")
 */
class Movement
{

      /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Line")

   * @ORM\JoinColumn(nullable=false)

   */

  private $line;

    /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\CodificationABB")

   * @ORM\JoinColumn(nullable=false)

   */

  private $codificationABB;

    /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Account")

   * @ORM\JoinColumn(nullable=true)

   */

  private $creditAccount;

   /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Account")

   * @ORM\JoinColumn(nullable=true)

   */

  private $debitAccount;

    /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\ExternalAccount")

   * @ORM\JoinColumn(nullable=true)

   */

  private $creditEAccount;

    /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\ExternalAccount")

   * @ORM\JoinColumn(nullable=true)

   */

  private $debitEAccount;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_mv", type="float")
     */
    private $amountMv;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_mv", type="datetime")
     */
    private $dateMv;

    /**
     * @var int
     *
     * @ORM\Column(name="months", type="integer", nullable=true)
     */
    private $months;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="real_date_mv", type="datetime")
     */
    private $realDateMv;


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
     * Set amountMv
     *
     * @param float $amountMv
     * @return Movement
     */
    public function setAmountMv($amountMv)
    {
        $this->amountMv = $amountMv;

        return $this;
    }

    /**
     * Get amountMv
     *
     * @return float 
     */
    public function getAmountMv()
    {
        return $this->amountMv;
    }

    /**
     * Set dateMv
     *
     * @param \DateTime $dateMv
     * @return Movement
     */
    public function setDateMv($dateMv)
    {
        $this->dateMv = $dateMv;

        return $this;
    }

    /**
     * Get dateMv
     *
     * @return \DateTime 
     */
    public function getDateMv()
    {
        return $this->dateMv;
    }

    /**
     * Set months
     *
     * @param integer $months
     * @return Movement
     */
    public function setMonths($months)
    {
        $this->months = $months;

        return $this;
    }

    /**
     * Get months
     *
     * @return integer 
     */
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * Set realDateMv
     *
     * @param \DateTime $realDateMv
     * @return Movement
     */
    public function setRealDateMv($realDateMv)
    {
        $this->realDateMv = $realDateMv;

        return $this;
    }

    /**
     * Get realDateMv
     *
     * @return \DateTime 
     */
    public function getRealDateMv()
    {
        return $this->realDateMv;
    }

    /**
     * Set line
     *
     * @param \compteBundle\Entity\Line $line
     * @return Movement
     */
    public function setLine(\compteBundle\Entity\Line $line)
    {
        $this->line = $line;

        return $this;
    }

    /**
     * Get line
     *
     * @return \compteBundle\Entity\Line 
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Set codificationABB
     *
     * @param \compteBundle\Entity\CodificationABB $codificationABB
     * @return Movement
     */
    public function setCodificationABB(\compteBundle\Entity\CodificationABB $codificationABB)
    {
        $this->codificationABB = $codificationABB;

        return $this;
    }

    /**
     * Get codificationABB
     *
     * @return \compteBundle\Entity\CodificationABB 
     */
    public function getCodificationABB()
    {
        return $this->codificationABB;
    }

    /**
     * Set creditAccount
     *
     * @param \compteBundle\Entity\Account $creditAccount
     * @return Movement
     */
    public function setCreditAccount(\compteBundle\Entity\Account $creditAccount)
    {
        $this->creditAccount = $creditAccount;

        return $this;
    }

    /**
     * Get creditAccount
     *
     * @return \compteBundle\Entity\Account 
     */
    public function getCreditAccount()
    {
        return $this->creditAccount;
    }

    /**
     * Set debitAccount
     *
     * @param \compteBundle\Entity\Account $debitAccount
     * @return Movement
     */
    public function setDebitAccount(\compteBundle\Entity\Account $debitAccount)
    {
        $this->debitAccount = $debitAccount;

        return $this;
    }

    /**
     * Get debitAccount
     *
     * @return \compteBundle\Entity\Account 
     */
    public function getDebitAccount()
    {
        return $this->debitAccount;
    }

    /**
     * Set creditEAccount
     *
     * @param \compteBundle\Entity\ExternalAccount $creditEAccount
     * @return Movement
     */
    public function setCreditEAccount(\compteBundle\Entity\ExternalAccount $creditEAccount)
    {
        $this->creditEAccount = $creditEAccount;

        return $this;
    }

    /**
     * Get creditEAccount
     *
     * @return \compteBundle\Entity\ExternalAccount 
     */
    public function getCreditEAccount()
    {
        return $this->creditEAccount;
    }

    /**
     * Set debitEAccount
     *
     * @param \compteBundle\Entity\ExternalAccount $debitEAccount
     * @return Movement
     */
    public function setDebitEAccount(\compteBundle\Entity\ExternalAccount $debitEAccount)
    {
        $this->debitEAccount = $debitEAccount;

        return $this;
    }

    /**
     * Get debitEAccount
     *
     * @return \compteBundle\Entity\ExternalAccount 
     */
    public function getDebitEAccount()
    {
        return $this->debitEAccount;
    }


    /**
     * unset Account
     *
     */
    public function unsetAccount($par)
    {
        switch ($par) {
            case 'CA':
                if (isset($this->creditAccount))
                unset($this->creditAccount);
                break;

            case 'CEA':
                if (isset($this->creditEAccount))
                unset($this->creditEAccount);
                break;

            case 'DA':
            if (isset($this->debitAccount))
                unset($this->debitAccount);
                break;

            case 'DEA':
            if (isset($this->debitEAccount))
                unset($this->debitEAccount);
                break;
            
        }
    }

}
