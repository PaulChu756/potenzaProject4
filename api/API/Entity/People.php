<?php

namespace API\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

/**
 *
 * @ORM\Table(name="People")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="API\Entity\PeopleRepository")
 * @author Paul Chu <paulchu756@gmail.com>
 */
class People
{
    /**
     *
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $_id;

    /**
     *
     * @var string
     * @ORM\Column(name="firstname", type="string", length=60, nullable=false)
     */
    protected $_firstName;

    /**
     *
     * @var string
     * @ORM\Column(name="lastname", type="string", length=60, nullable=false)
     */
    protected $_lastName;

    /**
     *
     * @var string
     * @ORM\Column(name="food", type="string", length=60, nullable=false)
     */
    protected $_favoriteFood;


    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    public function getId()
    {
        return $this->_id;
    }

    public function setFirstName($firstName)
    {
        $this->_firstName = (string) $firstName;
        return $this;
    }
    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function setLastName($lastName)
    {
        $this->_lastName = (string) $lastName;
        return $this;
    }
    public function getLastName()
    {
        return $this->_lastName;
    }

    public function setFavoriteFood($favoriteFood)
    {
        $this->_favoriteFood = (string) $favoriteFood;
        return $this;
    }
    public function getFavoriteFood()
    {
        return $this->_favoriteFood;
    }


}
