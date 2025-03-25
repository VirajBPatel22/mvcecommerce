<?php

class Checkout_Controller_Order extends Core_Controller_Customer_Action
{
    public function placeorderAction()
    {
        $cartModel = Mage::getSingleton('checkout/session')
            ->getCart();
        $convert = Mage::getModel('Checkout/Convert_Order')
            ->convert($cartModel);
        $cartModel->setIsActive(0)->save();
        Mage::getModel("core/session")
            ->remove("cart_id");
        $layout = Mage::getBlock('core/layout');
        $url = $layout->getUrl("Catalog/product/list");
        header("location:$url");
    }
   
}
