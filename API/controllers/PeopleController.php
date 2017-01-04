<?php

use Doctrine\ORM;
use API\Entity;

class API_PeopleController extends Ia_Controller_Action_Abstract
{
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

      if($this->getRequest()->isGet())
      {
        if($apiVars["people"] == null)
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

        elseif($apiVars["people"] != null)
        {
            echo "here"; die();
            $em = $this->getEntityManager();
            $peopleRepo = $em->getRepository('API\Entity\People')->find($apiVars["people"]);
            var_dump($peopleRepo);

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
      else if($this->getRequest()->isPost())
      {
          $request = $this->getRequest();
          $getPeopleValues = $request->getPost();
          $people = new API_Model_People();

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
          $peopleMapper = new API_Model_PeopleMapper();
          $peopleMapper->save($people);
      }
      else
      {
          throw new Exception("Error: findAll/Post didn't work", 1);
          die();
      }
  }
}

?>
