<?php
class ProductController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $product = new Application_Model_ProductMapper();
        $this->view->entries = $product->fetchAll(); 
    }
    
}