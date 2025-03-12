<?php

class Catalog_Controller_Product
{
    public function viewAction()
    {

        $product = Mage::getModel('catalog/product');
        $product->getResourceModel();
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('catalog/product_view')
            ->setTemplate('catalog/product/view.phtml');
        $layout->getChild('content')->addChild('view', $view);
        $layout->toHtml();
    }


    public function listAction()
    {
        $layout =  Mage::getBlockSingleton('Core/Layout');
        $list = $layout->createBlock('catalog/product_list')
            ->setTemplate('catalog/product/List.phtml');
        $layout->getChild('head')->addJs('catalog/filter.js');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function TestAction()
    {
        // $collections = Mage::getModel("catalog/filter")->getProductColllection();
        // $query = $collections->prepareQuery();
        // print($query);
        $collections = Mage::getSingleton('checkout/session')->getcart()
            ->getItemCollection()
            ->select(['sum(main_table.sub_total)'=>'SubTotal','item_id']);
        // $collections->PrepareQuery();


        Mage::log($collections->PrepareQuery());

    }
}
