<?php

class Admin_Controller_Product_Index extends Core_Controller_Admin_Action
{
    // protected $_allowedActions =['new'];
    public function newAction()
    {
        $product = Mage::getModel('catalog/product');
        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('Admin/Product_Index_New')
            ->setTemplate('admin/product/index/new.phtml');
        $layout->getChild('content')->addChild('new', $view);
        $layout->toHtml();
    }

    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('Admin/Product_Index_List')
            ->setTemplate('admin/product/index/list.phtml');
        $layout->getChild('content')->addChild('list', $view);
        $layout->toHtml();
    }

    public function saveAction()
    {
        $request = Mage::getModel("core/request");
        $data = $request->getParam('catalog_product');
        $name = substr($data["name"], 0, 5);
        $sku = $data["category_id"] . $name;
        $data["sku"] = $sku;
        Mage::getModel('catalog/product')->setData($data)->save();
        $url = Mage::getBaseUrl() . $request->getModuleName() . "/" . $request->getControllerName() . "/list";
        header("location: {$url}");
        exit();
    }

    public function deleteAction()
    {
        $request = Mage::getModel("core/request");
        $product = Mage::getModel('catalog/product');
        $id = $request->getQuery('id');
        $product->load($id);
        $product->delete();
        header("Location: " . Mage::getBaseUrl() . "admin/product_index/list");
        exit();
    }
}
