<?php
class Checkout_Block_Shipping_Index extends Core_Block_Layout{
    public function info()
    {
        // print_r($this);
        // return $this;
        $cartModel = Mage::getSingleton('checkout/session')
            ->getCart();
        return $cartModel->getShippingMethod();
    }
}
?>