<?php
class API_APIController extends Ia_Controller_Action_Abstract
{

    public function init()
    {
        $this->view->singular = 'api';
        $this->view->plural = 'apis';    
        $this->view->columns = array('id'=>'Id','title'=>'Title','active'=>'Active');
        $this->view->formats = array(
                'active' => array('YesNo'),
            );
        $this->view->detailColumns = $this->view->columns;
        $this->view->actions = array(
            'view'=>$this->actions('view'),
            'edit'=>$this->actions('edit'),
            'delete'=>$this->actions('delete'),
        );        
        $this->entity = new API\Entity\API;
        $this->createForm = new API_Form_API_CreateUpdate;
        $this->updateForm = new API_Form_API_CreateUpdate;    
        parent::init();
        $this->addFilterWidget('activeInactive','e.active',1);
    }  
    
}