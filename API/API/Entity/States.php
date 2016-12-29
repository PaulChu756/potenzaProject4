<?php

namespace API\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

/**
 *
 * @ORM\Table(name="States")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="API\Entity\StatesRepository")
 * @author Paul Chu <paulchu756@gmail.com>
 */
class States
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
     * @ORM\Column(name="stateabb", type="string", length=60, nullable=false)
     */
    protected $_stateAbb;

    /**
     *
     * @var string
     * @ORM\Column(name="statename", type="string", length=60, nullable=false)
     */
    protected $_stateName;


    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    public function getId()
    {
        return $this->_id;
    }

    public function getStateAbb($stateAbb)
    {
        $this->_stateAbb = (string) $stateAbb;
        return $this;
    }
    public function setStateAbb()
    {
        return $this->_stateAbb;
    }

    public function setStateName($stateName)
    {
        $this->_stateName = (string) $stateName;
        return $this;
    }
    public function getStateName()
    {
        return $this->_stateName;
    }
}
