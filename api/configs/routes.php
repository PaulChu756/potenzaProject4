<?php

// just route API to web application homepage
$APIRoute = new Zend_Controller_Router_Route(
    'API',
    array(
        'modules'       => 'API',
        'controller'    => 'index',
        'action'        => 'index'
    )
);
$router->addRoute('API', $APIRoute);



//get all people
$peopleRoute = new Zend_Controller_Router_Route(
    'API/people',
    array(
        'modules'       => 'API',
        'controller'    => 'people',
        'action'        => 'index'
    )
);
$router->addRoute('people', $peopleRoute);

//get a person by id
$personRoute = new Zend_Controller_Router_Route(
    'API/people/:peopleId',
    array(
        'modules'       => 'API',
        'controller'    => 'people',
        'action'        => 'get'
    )
);
$router->addRoute('peopleId', $personRoute);


//get all states
$statesRoute = new Zend_Controller_Router_Route(
    'API/states',
    array(
        'modules'       => 'API',
        'controller'    => 'states',
        'action'        => 'index'
    )
);
$router->addRoute('states', $statesRoute);

//get a states by id
$stateRoute = new Zend_Controller_Router_Route(
    'API/states/:stateId',
    array(
        'modules'       => 'API',
        'controller'    => 'states',
        'action'        => 'get'
    )
);
$router->addRoute('statesId', $stateRoute);


//get all visits
$visitsRoute = new Zend_Controller_Router_Route(
    'API/visits',
    array(
        'modules'       => 'API',
        'controller'    => 'visits',
        'action'        => 'index'
    )
);
$router->addRoute('visits', $visitsRoute);

//get a visits by id
$visitRoute = new Zend_Controller_Router_Route(
    'API/visits/:visitId',
    array(
        'modules'       => 'API',
        'controller'    => 'visits',
        'action'        => 'get'
    )
);
$router->addRoute('visitId', $visitRoute);

?>
