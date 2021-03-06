<?php

namespace compteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * Delegation
 *
 * @Gedmo\Loggable
 * @ORM\Table(name="delegation")
 * @ORM\Entity(repositoryClass="compteBundle\Repository\DelegationRepository")
 */
class Delegation
{
    
    /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Delegation")

   * @ORM\JoinColumn(nullable=true)

   */

  private $delegation;

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
     * @ORM\Column(name="depth", type="smallint")
     */
    private $depth;


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
     * @return Delegation
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
     * Set depth
     *
     * @param integer $depth
     * @return Delegation
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
     * Set delegation
     *
     * @param \compteBundle\Entity\Delegation $delegation
     * @return Delegation
     */
    public function setDelegation(\compteBundle\Entity\Delegation $delegation=null)
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

    public function removeParent()
    {
        unset($this->delegation);
    }


     /**
    * An entity shouldn't have itself as parent
    *
    * @Assert\Callback
    **/

    public function checkCashAvailability(ExecutionContextInterface $context){

       

        if ($this->getDelegation()!==null && $this->getId() == $this->getDelegation()->getId()) {
            $context
            ->buildViolation('An entity shouldn\'t have itself as parent')
            ->atPath('delegation')
            ->addViolation();
        }

    }
}
