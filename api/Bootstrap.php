<?php
class API_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _initRoutes()
    {
        $router = Zend_Controller_Front::getInstance()->getRouter();
        include APPLICATION_PATH . "modules/api/configs/routes.php";
    }
}