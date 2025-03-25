<?php

class Page_Block_Header extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('page/header.phtml');
    }
    public function CategoryData(){
        return  Mage::getModel('catalog/category')
            ->getCollection()
            ->getdata();
    }
    public function customerDetail(){
        $customerId = Mage::getSingleton('core/session')
            ->get('customer_id');
        $CustomerDetail = Mage::getModel('customer/account')
            ->load($customerId);
        return $CustomerDetail;
    }
    public function getLogin(){
        return Mage::getSingleton('core/session')
            ->get('login');
    }
    public function getcount(){
        $countdata = Mage::getSingleton('checkout/session')
        ->getcart()
        ->getItemCollection()
        ->getdata();
        return count($countdata);
    }
}
