<?php

class Checkout_Controller_Shipping
{
    public function indexAction()
    {
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('checkout/cart_shipping')
            ->setTemplate('checkout/cart/shipping.phtml');
        $layout->getChild('content')->addChild('shipping', $view);
        $layout->toHtml();
    }
    public function saveAction()
    {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        // die();
        $request = Mage::getModel('core/request');
        // $delimg = $request->getParam('catalog_image_delete');
        $shippingType = $request->getParam('shipping_type');
        $paymentMethod = $request->getParam('payment_method');

        $shippingModel = Mage::getModel('checkout/shipping');
        if (array_key_exists($shippingType, $shippingModel->getAllShipping())) {
            $shippingAmount = $shippingModel->CalculateShippingAmount($shippingType);
            // print($totalAmount-$totalDiscount);
            // die();
            $cartModel = Mage::getSingleton('checkout/session')
                ->getCart();
            $totalAmount = $cartModel->getTotalAmount();
            print($totalAmount);
            print("<br>");
            print($shippingAmount);
            var_dump((int)$totalAmount + (int)$shippingAmount);
            // die;
            $cartModel->setPaymentMethod($paymentMethod)
                ->setShippingMethod($shippingType)
                ->setShippingAmount($shippingAmount)
                ->save();
        }
        header("Location: http://localhost/ecommerecemvc/checkout/cart/index");

        // print('in coupon action');
        // die();
    }
}
