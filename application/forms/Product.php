<?php

class Application_Form_Product extends Zend_Form
{
    public function init()
    {
        $this->setName('product');
        
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Artist')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');
        
        $price = new Zend_Form_Element_Text('price');
        $price->setLabel('price')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $this->addElements(array($name, $price, $submit));
    }
}