<?php

//get all people
$peopleRoute = new Zend_Controller_Router_Route(
    'api/people',
    array(
        'modules'       => 'api',
        'controller'    => 'people',
        'action'        => 'index'
    )
);
$router->addRoute('people', $peopleRoute);

//get a person by id // testing for id because something is completely wrong
$personRoute = new Zend_Controller_Router_Route(
    'api/people/bro',
    array(
        'modules'       => 'api',
        'controller'    => 'people',
        'action'        => 'get'
    )
);
$router->addRoute('id', $personRoute);



//get all states
$statesRoute = new Zend_Controller_Router_Route(
    'api/states',
    array(
        'modules'       => 'api',
        'controller'    => 'states',
        'action'        => 'index'
    )
);
$router->addRoute('states', $statesRoute);

//get a states by id
$stateRoute = new Zend_Controller_Router_Route(
    'api/states/:id',
    array(
        'modules'       => 'api',
        'controller'    => 'states',
        'action'        => 'index'
    )
);
$router->addRoute('id', $stateRoute);



//get all visits
$visitsRoute = new Zend_Controller_Router_Route(
    'api/visits',
    array(
        'modules'       => 'api',
        'controller'    => 'visits',
        'action'        => 'index'
    )
);
$router->addRoute('visits', $visitsRoute);

//get a visits by id
$visitRoute = new Zend_Controller_Router_Route(
    'api/visits/:id',
    array(
        'modules'       => 'api',
        'controller'    => 'visits',
        'action'        => 'index'
    )
);
$router->addRoute('id', $visitRoute);

?>
