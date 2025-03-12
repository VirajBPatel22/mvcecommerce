<?php
class Checkout_Model_Cart extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = "Checkout_Model_Resource_Cart";
        $this->_CollectionClassName = "Checkout_Model_Resource_Cart_Collection";
    }
    public function AddProduct($product_id, $quentity)
    {
        $addproduct = Mage::getModel('checkout/cart_item')
            ->setProductId($product_id)
            ->setCartId($this->getCartId())
            ->setProductQuantity($quentity)
            ->save();
        return $this;
    }
    public function _beforesave()
    {
        // print('in befor save in cart model');
        $totalamount = 0;
        $cartitemdata = $this->getItemCollection()->getdata();
        // Mage::getModel('checkout/cart_item')->getCollection()
        // ->addFieldToFilter('cart_id',['='=>$this->getCartId()])->getdata();
        foreach ($cartitemdata as $cartamount) {
            $totalamount += $cartamount->getSubTotal();
        }
        $this->setTotalAmount($totalamount);
    }
    public function getItemCollection()
    {
        return Mage::getModel('checkout/cart_item')
            ->getCollection()
            ->addFieldToFilter('cart_id', ['=' => $this->getCartId()]);
    }
}
