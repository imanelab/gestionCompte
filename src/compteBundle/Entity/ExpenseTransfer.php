<?php

namespace compteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpenseTransfer
 *
 * @ORM\Table(name="expense_transfer")
 * @ORM\Entity(repositoryClass="compteBundle\Repository\ExpenseTransferRepository")
 */
class ExpenseTransfer
{
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
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;


        /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Paragraph")

   * @ORM\JoinColumn(nullable=false)

   */

  private $fromParagraph;



      /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Paragraph")

   * @ORM\JoinColumn(nullable=false)

   */

  private $toParagraph;



      /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Line")

   * @ORM\JoinColumn(nullable=false)

   */

  private $fromLine;


      /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Line")

   * @ORM\JoinColumn(nullable=false)

   */

  private $toLine;


        /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Morass")

   * @ORM\JoinColumn(nullable=false)

   */

  private $morass;


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
     * Set amount
     *
     * @param float $amount
     * @return ExpenseTransfer
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set fromParagraph
     *
     * @param \compteBundle\Entity\Paragraph $fromParagraph
     * @return ExpenseTransfer
     */
    public function setFromParagraph(\compteBundle\Entity\Paragraph $fromParagraph)
    {
        $this->fromParagraph = $fromParagraph;

        return $this;
    }

    /**
     * Get fromParagraph
     *
     * @return \compteBundle\Entity\Paragraph 
     */
    public function getFromParagraph()
    {
        return $this->fromParagraph;
    }

    /**
     * Set toParagraph
     *
     * @param \compteBundle\Entity\Paragraph $toParagraph
     * @return ExpenseTransfer
     */
    public function setToParagraph(\compteBundle\Entity\Paragraph $toParagraph)
    {
        $this->toParagraph = $toParagraph;

        return $this;
    }

    /**
     * Get toParagraph
     *
     * @return \compteBundle\Entity\Paragraph 
     */
    public function getToParagraph()
    {
        return $this->toParagraph;
    }

    /**
     * Set fromLine
     *
     * @param \compteBundle\Entity\Line $fromLine
     * @return ExpenseTransfer
     */
    public function setFromLine(\compteBundle\Entity\Line $fromLine)
    {
        $this->fromLine = $fromLine;

        return $this;
    }

    /**
     * Get fromLine
     *
     * @return \compteBundle\Entity\Line 
     */
    public function getFromLine()
    {
        return $this->fromLine;
    }

    /**
     * Set toLine
     *
     * @param \compteBundle\Entity\Line $toLine
     * @return ExpenseTransfer
     */
    public function setToLine(\compteBundle\Entity\Line $toLine)
    {
        $this->toLine = $toLine;

        return $this;
    }

    /**
     * Get toLine
     *
     * @return \compteBundle\Entity\Line 
     */
    public function getToLine()
    {
        return $this->toLine;
    }

    /**
     * Set morass
     *
     * @param \compteBundle\Entity\Morass $morass
     * @return ExpenseTransfer
     */
    public function setMorass(\compteBundle\Entity\Morass $morass)
    {
        $this->morass = $morass;

        return $this;
    }

    /**
     * Get morass
     *
     * @return \compteBundle\Entity\Morass 
     */
    public function getMorass()
    {
        return $this->morass;
    }
}
