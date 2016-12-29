<?php

namespace API\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

/**
 *
 * @ORM\Table(name="Visits")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="API\Entity\VisitsRepository")
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
     * @var integer
     * @ORM\Column(name="p_id", type="integer", nullable=false)
     */
    protected $_p_id;

    /**
     *
     * @var integer
     * @ORM\Column(name="s_id", type="integer", nullable=false)
     */
    protected $_s_id;

    /**
     *
     * @var string
     * @ORM\Column(name="date_visited", type="string", length=60, nullable=false)
     */
    protected $_date_visited;


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
    public function getS_Id()
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
}
