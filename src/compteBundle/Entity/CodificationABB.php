<?php

namespace compteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * CodificationABB
 *
 * @Gedmo\Loggable
 * @ORM\Table(name="codification_a_b_b")
 * @ORM\Entity(repositoryClass="compteBundle\Repository\CodificationABBRepository")
 */
class CodificationABB
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
     * @var int
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="code", type="smallint", unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="label", type="string", length=255)
     */
    private $label;


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
     * Set code
     *
     * @param integer $code
     * @return CodificationABB
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return CodificationABB
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }
}
