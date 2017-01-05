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

     public function __construct(array $options = null)
      {
          if (is_array($options)) {
              $this->setOptions($options);
          }
      }
      public function __set($name, $value)
      {
          $method = 'set' . $name;
          if (('mapper' == $name) || !method_exists($this, $method)) {
              throw new Exception('Invalid property');
          }
          $this->$method($value);
      }
      public function __get($name)
      {
          $method = 'get' . $name;
          if (('mapper' == $name) || !method_exists($this, $method)) {
              throw new Exception('Invalid property');
          }
          return $this->$method();
      }
      public function setOptions(array $options)
      {
          $methods = get_class_methods($this);
          foreach ($options as $key => $value) {
              $method = 'set' . ucfirst($key);
              if (in_array($method, $methods)) {
                  $this->$method($value);
              }
          }
          return $this;
      }
}
