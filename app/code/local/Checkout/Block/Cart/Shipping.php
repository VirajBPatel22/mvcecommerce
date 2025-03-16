<?php
class Checkout_Block_cart_Shipping extends Core_Block_Template {
    public function info(){
        // print_r($this);
        // return $this;
        $cartModel = Mage::getSingleton('checkout/session')
                ->getCart();
                return $cartModel->getShippingMethod();
    }
}


?>