<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class API_Bootstrap extends Zend_Application_Module_Bootstrap
{
  protected function _initRoutes()
  {
    $router = Zend_Controller_Front::getInstance()->getRouter();
    include APPLICATION_PATH . "/modules/api/configs/routes.php";
  }

  protected function _initAutoload()
  {
    $autoLoader = Zend_Loader_Autoloader::getInstance();
    
    $testModuleLoader = new Zend_Loader_Autoloader_Resource(array(
            'basePath' => APPLICATION_PATH . '/modules/api',
            'namespace' => 'API_',
            'resourceTypes' => array( 'form' => array( 'path'=>'forms/', 'namespace'=>'Form_' )    )
        ));
  }
}