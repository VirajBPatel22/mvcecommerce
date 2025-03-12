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
        $request = Mage::getModel('core/request');
        // $delimg = $request->getParam('catalog_image_delete');
        $product_id = $request->getParam('product_id');
        $quentity = $request->getParam('quentity');
        $cart = Mage::getSingleton('checkout/session')->getcart();  
        $cart->AddProduct($product_id,$quentity)->save();
        header("Location: http://localhost/ecommerecemvc/checkout/cart/index");
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('checkout/Cart_Add')
                    ->setTemplate('checkout/cart/add.phtml');
        $layout->getChild('content')->addChild('add', $view);
        $layout->toHtml();
    }

    public function testAction() {
        $collection = Mage::getModel('checkout/cart')->getCollection();
        print_r($collection);
        // echo get_class() . "----" . __FUNCTION__;
        // $layout =  Mage::getBlock('core/layout');
        // $view = $layout->createBlock('checkout/Cart_Add')
        //             ->setTemplate('checkout/cart/add.phtml');
        // $layout->getChild('content')->addChild('add', $view);
        // $layout->toHtml();
    }
}

?>