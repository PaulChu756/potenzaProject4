<?php

class API_Model_VisitsMapper
{
    protected $_dbTable;
    
    public function setDbTable($dbTable)
    {
        if(is_string($dbTable))
        {
            $dbTable = new $dbTable();
        }
        if(!$dbTable instanceof Zend_Db_Table_Abstract)
        {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
    
    public function getDbTable()
    {
        if( null === $this->_dbTable)
        {
            $this->setDbTable('API_Model_DbTable_Visits');
        }
        return $this->_dbTable;
    }

    public function save(API_Model_Visits $visits)
    {
        $data = array(
            'id'            => $visits->getId(),
            'p_id'          => $visits->getP_Id(),
            's_id'          => $visits->getS_Id(),
            'date_visited'  => $visits->getDate_Visited(),
        );

        if(null === ($id = $visits->getId()))
        {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        }
        else
        {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, API_Model_Visits $visits)
    {
        $result = $this->getDbTable()->find($id);
        if(0 == count($result))
        {
            echo "invalid get request";
            return;
        }
        $row = $result->current();
        $visits->setId($row->id)
                ->setP_Id($row->p_id)
                ->setS_Id($row->s_id)
                ->setDate_Visited($row->date_visited);

        $resultArray[] = 
        [
            'id'            => $visits->id,
            'p_id'          => $visits->p_id,
            's_id'          => $visits->s_id,
            'date_visited'  => $visits->date_visited
        ];

        echo json_encode($resultArray, JSON_PRETTY_PRINT);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach($resultSet as $row)
        {
            $entry = new API_Model_Visits();
            $entry->setId($row->id)
                    ->setP_Id($row->p_id)
                    ->setS_Id($row->s_id)
                    ->setDate_Visited($row->date_visited);
            $entries[] = $entry;
        }

        foreach($entries as $entryObj)
        {
            $resultArray[] = 
            [
                'id'                => $entryObj->id,
                'p_id'              => $entryObj->p_id,
                's_id'              => $entryObj->s_id,
                'date_visited'      => $entryObj->date_visited
            ];
        }
        echo json_encode($resultArray, JSON_PRETTY_PRINT);
    }
}

?>