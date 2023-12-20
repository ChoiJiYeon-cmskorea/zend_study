<?php
class IndexController extends Zend_Controller_Action {

    /* (non-PHPdoc)
     * @see Zend_Controller_Action::init()
     */
    public function init() {
    }

    public function indexAction() {
        $product = new Application_Model_DbTable_Product();
        $this->view->entries = $product->fetchAll(); 
        //페이징
        $this->view->paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array(array(1,2,3,4,5,6,'ggg')));
        
        //db 페이징
        /* $db = Zend_Db::factory('Pdo_Mysql', array(
                'host'     => 'localhost',
                'username' => 'root',
                'password' => 'cmskorea',
                'dbname'   => 'test'
        ));
        $adapter = new Zend_Paginator_Adapter_DbSelect($db->select()->from('product'));
        $adapter->setRowCount(
                $db->select()
                ->from('product',
                        array(
                        Zend_Paginator_Adapter_DbSelect::ROW_COUNT_COLUMN => 'ind'
                )));
        
        $paginator = new Zend_Paginator($adapter); */
    }
    public function addAction()
    {
        $form = new Application_Form_Product();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $name = $form->getValue('name');
                $price = $form->getValue('price');
                $product = new Application_Model_DbTable_Product();
                $product->addProduct($name, $price);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
        //쿠키 만들기 및 적용
        $cookie = new Zend_Http_Cookie('foo', 'bar', '.example.com', time() + 7200, '/path');
        $this->view->cookie = $cookie->getValue();
    }
}