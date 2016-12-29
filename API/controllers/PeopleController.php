<?php

use Doctrine\ORM;
use API\Entity;

class API_PeopleController extends Ia_Controller_Action_Abstract
{
  public function indexAction()
  {
      if($this->getRequest()->isGet())
      {
        $em = $this->getEntityManager();
        $peopleRepo = $em->getRepository('API\Entity\People');
        $people = $peopleRepo->findAll();

        foreach($people as $obj)
        {
          $resultArray[] = 
          [
            'id'         => $obj->id,
            'firstname'  => $obj->firstname,
            'lastname'   => $obj->lastname,
            "food"       => $obj->food
          ];
        }

        echo json_encode($resultArray, JSON_PRETTY_PRINT);
        var_dump($people);

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
        throw new Exception("Error: Get/Post didn't work and something went really wrong", 1);
      }
  }

  public function getAction()
  {
      $people = new API_Model_People();
      $peopleMapper = new API_Model_PeopleMapper();
      $request = $this->getRequest();
      $id = $request->getParam('peopleId');
      $this->view->entries = $peopleMapper->getPeopleVisits($id);
  }
}

?>
