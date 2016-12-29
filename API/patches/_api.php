<?php
if(php_sAPI_name()!=='cli')
    die('This script must be run from the command line.');

$queries = array();
$queries[] = 'SET FOREIGN_KEY_CHECKS=0;';
/*
 * Other queries here
 */
$queries[] = 'SET FOREIGN_KEY_CHECKS=1;';

foreach($queries as $query){
    $container->getEntityManager()->getConnection()->exec($query);
}