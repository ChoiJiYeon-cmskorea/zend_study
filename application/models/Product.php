<?php
class Application_Model_Product
{
    protected $_ind;
    protected $_name;
    protected $_price;
    protected $_time;
    
    public function __construct(array $product = null)
    {
        if (is_array($product)) {
            $this->setProduct($product);
        }
    }
    
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid product property');
        }
        $this->$method($value);
    }
    
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid product property');
        }
        return $this->$method();
    }
    
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    
    public function setInd($ind) {
        $this->_ind = $ind;
    }
    public function getInd() {
        return $this->_ind;
    }
    
    public function setName($name) {
        $this->_name = $name;
    }
    public function getName() {
        return $this->_name;
    }
    
    public function setPrice($price) {
        $this->_price = $price;
    }
    public function getPrice() {
        return $this->_price;
    }
    
    public function setTime($time) {
        $this->_time = $time;
    }
    public function getTime() {
        return $this->_time;
    }
}
