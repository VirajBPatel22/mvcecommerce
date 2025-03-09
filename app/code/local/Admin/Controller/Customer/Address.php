<?php

class Admin_Controller_Customer_Address {
    public function newAction() {
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('Admin/Customer_Address_New')
        ->setTemplate('admin/product/index/new.phtml');
        $layout->getChild('content')->addChild('new', $view);
        $layout->toHtml();

    }

    public function listAction() {
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('Admin/Customer_Address_List')
        ->setTemplate('admin/product/index/list.phtml');
        
        $layout->getChild('content')->addChild('list', $view);
        $layout->toHtml();
    }

    public function saveAction() {
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('Admin/Customer_Address_Save')
        ->setTemplate('admin/product/index/save.phtml');
        
        $layout->getChild('content')->addChild('save', $view);
        $layout->toHtml();

    }
    
    public function deleteAction() {
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('Admin/Customer_Address_Delete')
        ->setTemplate('admin/product/index/delete.phtml');
        
        $layout->getChild('content')->addChild('delete', $view);
        $layout->toHtml();
    }

}

?>