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
        $list->addBlockJs('filter.js');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function TestAction()
    {
        $collections = Mage::getModel("catalog/filter")->getProductColllection();
        $query = $collections->prepareQuery();
        print($query);

    }
}
