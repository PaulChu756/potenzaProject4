<?php

use Doctrine\ORM;
use API\Entity;

class API_StatesController extends Ia_Controller_Action_Abstract
{
    public function init()
    {
      $this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {
        $requestURI = parse_url($_SERVER['REQUEST_URI']);
        $segments = explode('/', $requestURI['path']);
        $apiVars = [];
        $i = 2;
        while($i < count($segments))
        {
            if($segments[$i+1])
            {
                $apiVars[$segments[$i]] = $segments[$i+1];
                $i += 2;
            }
            else
            {
                $apiVars[$segments[$i]] = null;
                $i++;
            }
        }
        if($apiVars["states"] == null)
        {
            $em = $this->getEntityManager();
            $statesRepo = $em->getRepository('API\Entity\States')->findAll();
            foreach($statesRepo as $obj)
            {
                $resultArray[] = 
                [
                    'id'            => $obj->getId(),
                    'stateabb'      => $obj->getStateAbb(),
                    'statename'     => $obj->getStateName()
                ];
            }
            echo json_encode($resultArray, JSON_PRETTY_PRINT);
        }
        else
        {
            echo "test: to get one state"; die();
            $em = $this->getEntityManager();
            $statesRepo = $em->getRepository('API\Entity\States')->find($apiVars["states"]);

            $resultArray[] = 
            [
                'id'            => $obj->getId(),
                'stateabb'      => $obj->getStateAbb(),
                'statename'     => $obj->getStateName()
            ];
            
            echo json_encode($resultArray, JSON_PRETTY_PRINT);
        }
    }
}

?>
