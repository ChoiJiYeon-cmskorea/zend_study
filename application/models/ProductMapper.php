<?php
class Application_Model_ProductMapper
{
    protected $_dbTable;
    
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
    
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Product');
        }
        return $this->_dbTable;
    }
    
    public function save(Application_Model_Product $product)
    {
        $data = array(
                'ind'   => $product->getInd(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'time' => $product->getTime()
        );
        
        if (null === ($Ind = $product->getInd())) {
            unset($data['ind']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('ind = ?' => $ind));
        }
    }
    
    public function find($ind, Application_Model_Product $product)
    {
        $result = $this->getDbTable()->find($ind);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $product->setInd($row->ind);
        $product->setName($row->name);
        $product->setPrice($row->price);
        $product->setTime($row->time);
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Product();
            $entry->setInd($row->ind);
            $entry->setName($row->name);
            $entry->setPrice($row->price);
            $entry->setTime($row->time);
            $entries[] = $entry;
        }
        return $entries;
    }
}