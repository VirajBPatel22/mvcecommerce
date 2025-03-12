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

    
    public function updateAction()
    {

        $request = Mage::getModel('core/request')->getParams();
        $item_id = $request['item_id'];
        $quantity = $request['quantity'];
        Mage::getSingleton('checkout/session')->getCart()
            ->updateItem($item_id, $quantity)
            ->save();

        header("Location: http://localhost/ecommerecemvc/checkout/cart/index ");
    }

    public function removeAction()
    {

        $delete_id = Mage::getModel("core/request")->getQuery('item_id');
        Mage::getSingleton('checkout/session')->getCart()
            ->removeItem($delete_id)
            ->save();
        header("Location: http://localhost/ecommerecemvc/checkout/cart/index");
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

    public function couponAction(){
        $request = Mage::getModel('core/request');
        // $delimg = $request->getParam('catalog_image_delete');
        $couponCode = $request->getParam('coupon_code');
        $totalAmount=$request->getParam('total_price');
        $couponModel = Mage::getModel('checkout/coupon');
        if(array_key_exists($couponCode,$couponModel->getAllCoupon())){
            $totalDiscount = $couponModel->CalculateDiscount($couponCode,$totalAmount);
            print($totalAmount-$totalDiscount);
            // die();
            $cartModel = Mage::getSingleton('checkout/session')
            ->getCart()
                ->setTotalAmount($totalAmount-$totalDiscount)
                ->setCouponCode($couponCode)
                ->setCouponDiscount($totalDiscount)
                ->save();


        }
        header("Location: http://localhost/ecommerecemvc/checkout/cart/index");

        // print('in coupon action');
        // die();
    }
    public function addressAction() {
        // echo get_class() . "<br>" . __FUNCTION__;
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('checkout/Cart_address')
                    ->setTemplate('checkout/cart/address.phtml');
        $layout->getChild('content')->addChild('address', $view);
        $layout->toHtml();
    }
    public function saveaddressAction(){
        $request=Mage::getModel('core/request')
            ->getparams();
        
        $cartId= Mage::getSingleton('checkout/session')
            ->getCart()
            ->setEmail($request['email'])
            ->save()
            ->getCartId();
        $billing = array_merge($request['personal'], $request['billing']);
        $billing['cart_id']=$cartId;
        $shipping = array_merge($request['personal'], $request['shipping']);
        $shipping['cart_id']=$cartId;
        $billing['typeofaddress']='billing';
        $shipping['typeofaddress']='shipping';
        Mage::getModel('checkout/cart_address')->setData($billing)->save();
        Mage::getModel('checkout/cart_address')->setData($shipping)->save();
        header("Location: http://localhost/ecommerecemvc/checkout/cart/shipping");

    }
    // public function saveaddressAction(){
    //     echo "<pre>";
    //     print_r($_POST);
    //     echo "</pre>";
    //     $request=Mage::getModel('core/request')
    //         ->getparams();
        
    //     $cartId= Mage::getSingleton('checkout/session')
    //         ->getCart()
    //         ->setEmail($request['email'])
    //         ->save()
    //         ->getCartId();
    //     $billing = array_merge($request['personal'], $request['billing']);
    //     $billing['cart_id']=$cartId;
    //     $shipping = array_merge($request['personal'], $request['shipping']);
    //     $shipping['cart_id']=$cartId;
    //     echo "<pre>";
    //     print('11233');
    //     print_r($shipping);
    //     echo "</pre>";
    //     // die();
    //     $billing['typeofaddress']='billing';
    //     $shipping['typeofaddress']='shipping';
    //     $model = Mage::getModel('checkout/cart_address')->load(4);
    //     print('123');
    //     echo "<pre>";
    //     print_r($model->getdata());
    //     echo "</pre>";
    //     // die();
    //     $model->setData($billing)->setAddressId(4)->save();
    //     die();
    //     print('23445');
    //     echo "<pre>";

    //     print_r($model);
    //     $model->setData($shipping)->save();
    //     die();
    //     // Mage::getModel('checkout/cart_address')->setAddressId(4)->
    //     $model1 = Mage::getModel('checkout/cart_address')->load(5);
    //     // array_push($billing,['cart_id'=>10]);
    //     // die();
    // }
    public function shippingAction(){
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('checkout/cart_shipping')
            ->setTemplate('checkout/cart/shipping.phtml');
        $layout->getChild('content')->addChild('shipping', $view);
        $layout->toHtml();
        
    }
    public function saveshippingAction(){
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        // die();
        $request = Mage::getModel('core/request');
        // $delimg = $request->getParam('catalog_image_delete');
        $shippingType = $request->getParam('shipping_type');
        $paymentMethod=$request->getParam('payment_method');
        
        $shippingModel = Mage::getModel('checkout/shipping');
        if(array_key_exists($shippingType,$shippingModel->getAllShipping())){
            $shippingAmount = $shippingModel->CalculateShippingAmount($shippingType);
            // print($totalAmount-$totalDiscount);
            // die();
            $cartModel = Mage::getSingleton('checkout/session')
                ->getCart();
            $totalAmount = $cartModel->getTotalAmount();
            print($totalAmount);
print("<br>");
            print($shippingAmount);
            var_dump((int)$totalAmount+(int)$shippingAmount);
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


    public function testAction() {
        $collection = Mage::getModel('checkout/cart')->getCollection();
        print_r($collection);
    }

}

?>