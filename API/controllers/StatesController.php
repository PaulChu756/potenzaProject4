<?php

use Doctrine\ORM;
use API\Entity;

class API_StatesController extends Ia_Controller_Action_Abstract
{
    public function indexAction()
    {
        $em = $this->getEntityManager();
        $statesRepo = $em->getRepository('API\Entity\States');
        $states = $statesRepo->findAll();

        foreach($states as $obj)
        {
            $resultArray[] = 
            [
            'id'            => $obj->getId(),
            'stateabb'      => $obj->getStateAbb(),
            'statename'     => $obj->getStateName()
            ];
        }
        echo json_encode($resultArray, JSON_PRETTY_PRINT);
        var_dump($states);
  }

  public function getAction()
  {
      $states = new API_Model_States();
      $statesMapper = new API_Model_StatesMapper();
      $request = $this->getRequest();
      $id = $request->getParam('stateId');
      $this->view->entries = $statesMapper->find($id, $states);
  }
}

?>
