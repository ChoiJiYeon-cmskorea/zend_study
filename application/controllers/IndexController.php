<?php
//require_once __DIR__ . '/../models/DbTable/Product.php';
class IndexController extends Zend_Controller_Action {

    /* (non-PHPdoc)
     * @see Zend_Controller_Action::init()
     */
    public function init() {
    }

    public function indexAction() {
        $product = new Application_Model_DbTable_Product();
        $this->view->entries = $product->fetchAll(); 
    }

}