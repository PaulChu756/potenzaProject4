<?php
//require_once "bootstrap.php";
require_once "People.php";

$newPerson = $argv[1];

$people = new People();
$people->setFirstName($newPerson);

$em->PrePersist($people);
$em->flush();

echo "create person with ID" . $people->getId() . "\n";
?>
