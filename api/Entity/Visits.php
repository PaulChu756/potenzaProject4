<?php

namespace Visits\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 *
 * @ORM\Table(name="Visits")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="VisitsRepository")
 * @author Paul Chu <paulchu756@gmail.com>
 */
class Visits
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
     * @ORM\Column(name="p_id", type="integer", nullable=false)
     */
    protected $_p_id;

    /**
     *
     * @var string
     * @ORM\Column(name="s_id", type="integer", nullable=false)
     */
    protected $_s_id;

    /**
     *
     * @var string
     * @ORM\Column(name="data_visited", type="string", length=60, nullable=false)
     */
    protected $_date_visited;


public function __construct(array $options = null)
    {
        if(is_array($options))
        {
            $this->setOptions($options);
        }
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach($options as $key => $value)
        {
            $method = 'set' . ucfirst($key);
            if(in_array($method, $methods))
            {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    public function getId()
    {
        return $this->_id;
    }

    public function setP_Id($p_id)
    {
        $this->_p_id = (int) $p_id;
        return $this;
    }
    public function getP_Id()
    {
        return $this->_p_id;
    }

    public function setS_Id($s_id)
    {
        $this->_s_id = (int) $s_id;
        return $this;
    }
    public function GetS_Id()
    {
        return $this->_s_id;
    }

    public function setDate_Visited($date_visited)
    {
        $this->_date_visited = (string) $date_visited;
        return $this;
    }
    public function getDate_Visited()
    {
        return $this->_date_visited;
    }

     /**
     *
     * \Doctrine\Entity\Manager
     */
    public $em = null;

    /**
     * Get Doctrine Entity Manager
     * @return \Doctrine\Entity\Manager
     */
    public function getEntityManager() {
        if($this->em===null){
            $dc = \Zend_Registry::get('doctrine');
            $this->em = $dc->getEntityManager();
        }
        return $this->em;
    }

    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property) {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value) {
        $this->$property = $value;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function toArray() {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * Create an entity with the given data
     *
     * @param array $data
     * @return object
     */
    public function createEntity(array $data)
    {
        $metadata = $this->getEntityManager()->getClassMetadata(get_class($this));
        if(isset($data['id'])){
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        }
        $entity = $metadata->newInstance();
        return $this->updateEntity($entity,$data);
    }

    /**
     * Update an entity with the given data
     *
     * @param array $data
     * @return object
     */
    public function updateEntity($entity, array $data)
    {
        $metadata = $this->getEntityManager()->getClassMetadata(get_class($this));
        foreach($data as $property => $value){
            if(!$metadata->reflClass->hasProperty($property))
                continue;
            $metadata->setFieldValue($entity, $property, $value);
        }
        return $entity;
    }

    /** @ORM\PrePersist */
    public function prePersist()
    {
        $this->created_at = new \DateTime;
        $this->updated_at = new \DateTime;
    }

    /** @ORM\PreUpdate */
    public function preUpdate()
    {
        $this->updated_at = new \DateTime;
    }

}
