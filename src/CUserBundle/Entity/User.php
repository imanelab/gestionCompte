<?php

namespace CUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="CUserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
	/**

   * @ORM\ManyToOne(targetEntity="compteBundle\Entity\MasterEntity")

   * @ORM\JoinColumn(nullable=true)

   */

  protected $masterEntity;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

 	/**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    protected $firstName;

     /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    protected $lastName;


    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set masterEntity
     *
     * @param \compteBundle\Entity\MasterEntity $masterEntity
     * @return User
     */
    public function setMasterEntity(\compteBundle\Entity\MasterEntity $masterEntity)
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
}
