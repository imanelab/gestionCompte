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
}
