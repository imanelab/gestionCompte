<?php

namespace compteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paragraph
 *
 * @ORM\Table(name="paragraph")
 * @ORM\Entity(repositoryClass="compteBundle\Repository\ParagraphRepository")
 */
class Paragraph
{

         /**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\Morass")

   * @ORM\JoinColumn(nullable=false)

   */

  private $morass;

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
     * @ORM\Column(name="idp", type="integer")
     */
    private $idp;


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
     * Set idp
     *
     * @param integer $idp
     * @return Paragraph
     */
    public function setIdp($idp)
    {
        $this->idp = $idp;

        return $this;
    }

    /**
     * Get idp
     *
     * @return integer 
     */
    public function getIdp()
    {
        return $this->idp;
    }

    /**
     * Set morass
     *
     * @param \compteBundle\Entity\Morass $morass
     * @return Paragraph
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
