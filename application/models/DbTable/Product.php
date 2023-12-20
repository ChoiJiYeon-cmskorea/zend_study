<?php
class Application_Model_DbTable_Product extends Zend_Db_Table_Abstract
{
    /** Table name */
    protected $_name = 'product';
    public function getProduct($ind)
    {
        $ind = (int)$ind;
        $row = $this->fetchRow('ind = ' . $ind);
        if (!$row) {
            throw new Exception("Could not find row $ind");
        }
        return $row->toArray();
    }
    public function addProduct($name, $price)
    {
        $data = array(
                'name' => $name,
                'price' => $price,
        );
        $this->insert($data);
    }
}