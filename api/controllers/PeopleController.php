<?php

use Doctrine\ORM;
use API\Entity;

class API_PeopleController extends Ia_Controller_Action_Abstract
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

      if($apiVars["people"] == null)
      {
        if($this->getRequest()->isGet())
        {
            $em = $this->getEntityManager();
            $peopleRepo = $em->getRepository('API\Entity\People')->findAll();
            foreach($peopleRepo as $obj)
            {
              $resultArray[] = 
              [
                'id'         => $obj->getId(),
                'firstname'  => $obj->getFirstName(),
                'lastname'   => $obj->getLastName(),
                "food"       => $obj->getFavoriteFood()
              ];
            }
            echo json_encode($resultArray, JSON_PRETTY_PRINT);
        }
        else if($this->getRequest()->isPost())
        {
            $request = $this->getRequest();
            $getPeopleValues = $request->getPost();
            $people = new API\Entity\People();

            $firstName = $getPeopleValues['firstName'];
            $lastName = $getPeopleValues['lastName'];
            $favFood = $getPeopleValues['favoriteFood'];

            if(empty($firstName) || empty($lastName) || empty($favFood))
            {
              throw new Exception("Please fill out all inputs", 1);
            }

            $people   ->setFirstName($firstName)
                      ->setLastName($lastName)
                      ->setFavoriteFood($favFood);
            $em = $this->getEntityManager();
            $em        ->persist($people);
            $em        ->flush();
        }  
      }
      else
      {
          echo "test: to get one person"; die();
          $em = $this->getEntityManager();
          $peopleRepo = $em->getRepository('API\Entity\People')->find($apiVars["people"]);

          $resultArray[] = 
          [
            'id'         => $peopleRepo->getId(),
            'firstname'  => $peopleRepo->getFirstName(),
            'lastname'   => $peopleRepo->getLastName(),
            "food"       => $peopleRepo->getFavoriteFood()
          ];
          
          echo json_encode($resultArray, JSON_PRETTY_PRINT);
      }
    }

    public function getAction()
    {
      echo "testtttttttttttttttt";die();
    }
}

?>
