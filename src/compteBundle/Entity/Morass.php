<?php

namespace compteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Morass
 *
 * @ORM\Table(name="morass")
 * @ORM\Entity(repositoryClass="compteBundle\Repository\MorassRepository")
 * @Gedmo\Loggable
 */
class Morass
{


    /** 
    @ORM\OneToOne(targetEntity="compteBundle\Entity\Delegation")
   * @ORM\JoinColumn(nullable=true)
   */

  private $delegation;

      /** 
    @ORM\ManyToOne(targetEntity="CUserBundle\Entity\User")
   * @ORM\JoinColumn(nullable=true)
   */

  private $user;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="year", type="smallint", unique=true)
     */
    private $year;


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
     * Set name
     *
     * @param string $name
     * @return Morass
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Morass
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set delegation
     *
     * @param \compteBundle\Entity\Delegation $delegation
     * @return Morass
     */
    public function setDelegation(\compteBundle\Entity\Delegation $delegation = null)
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
     * Set user
     *
     * @param \CUserBundle\Entity\User $user
     * @return Morass
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
