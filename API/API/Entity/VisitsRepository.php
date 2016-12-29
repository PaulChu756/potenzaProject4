<?php
/*
 * http://docs.doctrine-project.org/en/latest/tutorials/getting-started.html#entity-repositories
 */

namespace API\Entity;

use Doctrine\ORM\EntityRepository;

class VisitsRepository extends EntityRepository
{
    //EntityRepository has functions called find(); findAll(); 
    //need to know if it has a save function and also make a custom funciton for inner join to visits
}
