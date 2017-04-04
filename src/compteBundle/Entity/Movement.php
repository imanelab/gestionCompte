<?php

namespace compteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
// Ajoutez ce use pour le contexte
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Movement
 *
 * @ORM\Table(name="movement")
 * @ORM\Entity(repositoryClass="compteBundle\Repository\MovementRepository")
 */
class Movement
{

    /**

   * @ORM\ManyToOne(targetEntity="CUserBundle\Entity\User")

   * @ORM\JoinColumn(nullable=true)

   */

  private $user;

      /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Line")

   * @ORM\JoinColumn(nullable=false)

   */

  private $line;

    /**

   * @ORM\ManyToOne(targetEntity="CUserBundle\Entity\User")

   * @ORM\JoinColumn(nullable=true)

   */

  private $valdiator;

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
     * @var boolean
     *
     * @ORM\Column(name="validation", type="boolean")
     */
    private $validation=false;

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
     * @var text
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

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
                $this->creditAccount=null;
                break;

            case 'CEA':
                 $this->creditEAccount=null;
                break;

            case 'DA':
                 $this->debitAccount=null;
                break;

            case 'DEA':
                 $this->debitEAccount=null;
                break;
            
        }
    }


     /**
    * Check the possibility to execute the movement (line has enough cash) 
    *
    * @Assert\Callback
    **/

    public function checkCashAvailability(ExecutionContextInterface $context){

        $lineAmount= $this->getLine()->getAmount();
        $lineConsumedAmount= $this->getLine()->getConsumedAmount();
        $movementAmount= $this->getAmountMv();

        $remainingCash = $lineAmount - $lineConsumedAmount;
        $postRemainingCash= $remainingCash - $movementAmount;

        if ($postRemainingCash <0) {
            $context
            ->buildViolation('Somme non dotée')
            ->atPath('line')
            ->addViolation();
        }

        if ($this->months >12) {
            $context
            ->buildViolation('mois + que 12')
            ->atPath('months')
            ->addViolation();
        }

        if ($this->realDateMv < $this->dateMv) {
            $context
            ->buildViolation('dates fchkeeel')
            ->atPath('dateMv')
            ->addViolation();
        }


    }


    /**
     * Set comment
     *
     * @param string $comment
     * @return Movement
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set validation
     *
     * @param boolean $validation
     * @return Movement
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get validation
     *
     * @return boolean 
     */
    public function getValidation()
    {
        return $this->validation;
    }
}
