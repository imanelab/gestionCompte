<?php

namespace compteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Line
 *
 * @ORM\Table(name="line")
 * @ORM\Entity(repositoryClass="compteBundle\Repository\LineRepository")
 * @Gedmo\Loggable
 */
class Line
{
    /**

   * @ORM\ManyToMany(targetEntity="compteBundle\Entity\MasterEntity", cascade={"persist"})

   */

    private $masterEntities;

    /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Paragraph")

   * @ORM\JoinColumn(nullable=false)

   */

  private $paragraph;

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
     * @Gedmo\Versioned
     * @ORM\Column(name="amount", type="float", nullable=true)
     */
    private $amount;

    /**
     * @var int
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="version", type="smallint")
     */
    private $version;
	
	private $codeTitle;

    /**
     * @var int
     *
     * @ORM\Column(name="idl", type="smallint")
     */
    private $idl;




    /**
     * @var float
     *
     * @ORM\Column(name="consumed_amount", type="float", nullable=true)
     */
    private $consumedAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string",length=255)
     */
    private $title;



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
     * @return Line
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
     * Set version
     *
     * @param integer $version
     * @return Line
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set paragraph
     *
     * @param \compteBundle\Entity\Paragraph $paragraph
     * @return Line
     */
    public function setParagraph(\compteBundle\Entity\Paragraph $paragraph)
    {
        $this->paragraph = $paragraph;

        return $this;
    }

    /**
     * Get paragraph
     *
     * @return \compteBundle\Entity\Paragraph 
     */
    public function getParagraph()
    {
        return $this->paragraph;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->masterEntities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add masterEntities
     *
     * @param \compteBundle\Entity\MasterEntity $masterEntities
     * @return Line
     */
    public function addMasterEntity(\compteBundle\Entity\MasterEntity $masterEntities)
    {
        $this->masterEntities[] = $masterEntities;

        return $this;
    }

    /**
     * Remove masterEntities
     *
     * @param \compteBundle\Entity\MasterEntity $masterEntities
     */
    public function removeMasterEntity(\compteBundle\Entity\MasterEntity $masterEntities)
    {
        $this->masterEntities->removeElement($masterEntities);
    }

    /**
     * Get masterEntities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMasterEntities()
    {
        return $this->masterEntities;
    }

    /**
     * Set idl
     *
     * @param integer $idl
     * @return Line
     */
    public function setIdl($idl)
    {
        $this->idl = $idl;

        return $this;
    }

    /**
     * Get idl
     *
     * @return integer 
     */
    public function getIdl()
    {
        return $this->idl;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Line
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Set consumedAmount
     *
     * @param float $consumedAmount
     * @return Line
     */
    public function setConsumedAmount($consumedAmount)
    {
        $this->consumedAmount = $consumedAmount;

        return $this;
    }

    /**
     * Get consumedAmount
     *
     * @return float 
     */
    public function getConsumedAmount()
    {
        return $this->consumedAmount;
    }
	
	
	
	public function getcodeTitle()
    {
		$codeTitle= $this->idl   .":".   $this->title;
        return $codeTitle;
    }

}
