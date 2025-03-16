<?php 
class Checkout_Controller_Address{
    public function indexAction() {
        // echo get_class() . "<br>" . __FUNCTION__;
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('checkout/Address_Index')
                    ->setTemplate('checkout/address/index.phtml');
        $layout->getChild('content')->addChild('address', $view);
        $layout->toHtml();
    }
    public function saveAction(){
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
        $billinginfo = Mage::getBlock('checkout/address_index')->billinginfo();
        $shippinginfo = Mage::getBlock('checkout/address_index')->shippinginfo();
        if($billinginfo){
            $billingAddressId = $billinginfo->getfirstItem()->getAddressId();
            $billing['address_id']=$billingAddressId;
        }
        if($shippinginfo){
            $shippingAddressId = $shippinginfo->getfirstItem()->getAddressId();
            $shipping['address_id']=$shippingAddressId;
        }
        Mage::getModel('checkout/cart_address')->setData($billing)->save();
        Mage::getModel('checkout/cart_address')->setData($shipping)->save();
        header("Location: http://localhost/ecommerecemvc/checkout/shipping/index");

    }

}
?>