<?php
class Customer_Controller_Account_Profile extends Core_Controller_Customer_Action{
    public function dashboardAction(){
        $customerId = Mage::getSingleton('core/session')
            ->get('customer_id');
        $customer = Mage::getModel('customer/account')->load($customerId);
        $layout = Mage::getBlock("core/layout");
        $viewCustomer = $layout->createBlock("customer/account_profile_dashboard");

        
        $layout->getChild("content")->addChild("dashboard", $viewCustomer);
        $viewCustomer->setCustomer($customer);
        $dashboardDetails = $layout->createBlock("customer/account_profile_dashboard_details");
        $layout->getChild("content")
            ->getChild("dashboard")
            ->addChild("dashboard_details", $dashboardDetails);
        // $orderInfo->setOrderInfo($viewOrder);
        
        $dashboardAddress = $layout->createBlock("customer/account_profile_dashboard_address");
        $layout->getChild("content")
            ->getChild("dashboard")
            ->addChild("dashboard_address", $dashboardAddress);

        // $orderAddressinfo = $layout->createBlock("admin/order_view_address");
        // $layout->getChild("content")->getChild("order")->addChild("order_address", $orderAddressinfo);
        // // $orderAddressinfo->setOrderAddress($viewOrder);
        
        // $orderIteminfo = $layout->createBlock("admin/order_view_item");
        // $layout->getChild("content")->getChild("order")->addChild("order_item", $orderIteminfo);
        // // $orderIteminfo->setOrderItem($viewOrder);
        
        $layout->toHtml();
    }
}
?>