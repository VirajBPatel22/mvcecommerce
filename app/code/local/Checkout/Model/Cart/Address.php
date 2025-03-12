<?php
class Checkout_Model_Cart_Address extends Core_Model_Abstract{
    // protected $_product;

    public function init(){
        $this->_resourceClassName = "Checkout_Model_Resource_Cart_Address";
        $this->_CollectionClassName = "Checkout_Model_Resource_Cart_Address_Collection";
}
}
?>