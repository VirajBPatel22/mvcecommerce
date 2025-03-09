<?php

class Checkout_Controller_Cart {
    public function indexAction() {
        // echo get_class() . "<br>" . __FUNCTION__;
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('checkout/Cart_Index')
                    ->setTemplate('checkout/cart/index.phtml');
        $layout->getChild('content')->addChild('index', $view);
        $layout->toHtml();
    }

    public function updateAction() {
        // echo get_class() . "----" . __FUNCTION__;
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('checkout/Cart_Update')
                    ->setTemplate('checkout/cart/update.phtml');
        $layout->getChild('content')->addChild('update', $view);
        $layout->toHtml();
    }

    public function removeAction() {
        // echo get_class() . "----" . __FUNCTION__;
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('checkout/Cart_Remove')
                    ->setTemplate('checkout/cart/remove.phtml');
        $layout->getChild('content')->addChild('remove', $view);
        $layout->toHtml();
    }

    public function addAction() {
        // echo get_class() . "----" . __FUNCTION__;
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('checkout/Cart_Add')
                    ->setTemplate('checkout/cart/add.phtml');
        $layout->getChild('content')->addChild('add', $view);
        $layout->toHtml();
    }
}

?>