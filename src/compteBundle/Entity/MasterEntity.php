<?php

namespace compteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * MasterEntity
 *
 * @ORM\Table(name="master_entity")
 * @ORM\Entity(repositoryClass="compteBundle\Repository\MasterEntityRepository")
 * @Gedmo\Loggable
 */
class MasterEntity
{
         /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\MasterEntity")

   * @ORM\JoinColumn(nullable=true)

   */

  private $masterEntity;

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
     * @ORM\Column(name="depth", type="integer")
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
     * @return MasterEntity
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
     * @return MasterEntity
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
     * Set masterEntity
     *
     * @param \compteBundle\Entity\MasterEntity $masterEntity
     * @return MasterEntity
     */
    public function setMasterEntity(\compteBundle\Entity\MasterEntity $masterEntity=null)
    {
        $this->masterEntity = $masterEntity;

        return $this;
    }

    /**
     * Get masterEntity
     *
     * @return \compteBundle\Entity\MasterEntity 
     */
    public function getMasterEntity()
    {
        return $this->masterEntity;
    }

        public function removeParent()
    {
        unset($this->masterEntity);
    }

     /**
    * An entity shouldn't have itself as parent
    *
    * @Assert\Callback
    **/

    public function checkCashAvailability(ExecutionContextInterface $context){

       

        if ($this->getMasterEntity()!==null && $this->getId() == $this->getMasterEntity()->getId()) {
            $context
            ->buildViolation('An entity shouldn\'t have itself as parent')
            ->atPath('masterEntity')
            ->addViolation();
        }

    }
}
