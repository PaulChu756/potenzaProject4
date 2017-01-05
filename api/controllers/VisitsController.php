<?php

use Doctrine\ORM;
use API\Entity;

class API_VisitsController extends Ia_Controller_Action_Abstract
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

    if($apiVars["visits"] == null)
    {
       if($this->getRequest()->isGet())
        {
            $em = $this->getEntityManager();
            $visitsRepo = $em->getRepository('API\Entity\Visits');
            $visits = $visitsRepo->findAll();

            foreach($visits as $obj)
            {
              $resultArray[] = 
              [
                'id'            => $obj->getId(),
                'p_id'          => $obj->getP_Id(),
                's_id'          => $obj->getS_Id(),
                "date_visited"  => $obj->getDate_Visited()
              ];
            }
            echo json_encode($resultArray, JSON_PRETTY_PRINT);
        }
        else if($this->getRequest()->isPost())
        {
          $request = $this->getRequest();
          $getVisitsValues = $request->getPost();
          $visits = new API_Model_Visits();

          $humanName = $getVisitsValues['humanNameDropDown'];
          $stateName = $getVisitsValues['stateNameDropDown'];
          $dataVisit = $getVisitsValues['dateVisit'];

          if(empty($humanName) || empty($stateName) || empty($dataVisit))
          {
            throw new Exception("Please fill out all inputs", 1);
          }

          $visits   ->setP_Id($humanName)
                    ->setS_Id($stateName)
                    ->setDate_Visited($dataVisit);
          $visitsMapper = new API_Model_VisitsMapper();
          $visitsMapper->save($visits);
        }
      }
      else
      {
          echo "test: to get one visit"; die();
          $em = $this->getEntityManager();
          $visitsRepo = $em->getRepository('API\Entity\Visits')->find($apiVars["visits"]);

          $resultArray[] = 
          [
            'id'            => $obj->getId(),
            'p_id'          => $obj->getP_Id(),
            's_id'          => $obj->getS_Id(),
            "date_visited"  => $obj->getDate_Visited()
          ];
          
          echo json_encode($resultArray, JSON_PRETTY_PRINT);
      }
  }
}

?>
