<?php

class Admin_Block_Category_Index_List extends Core_Block_Template
{
    protected $_collection;
    public function __construct()
    {

        $this->init();
    }
    public function init()
    {
        $layout=$this->getLayout();
        $toolbar_block=$layout->createBlock("Admin/grid_toolbar")
                        ->setTemplate("admin/grid/toolbar.phtml");
        
        $product = Mage::getModel("catalog/category");
       $this->addChild("toolbar",$toolbar_block);
    

        $this->_collection = $product->getCollection();
        
        $toolbar_block->prepareToolbar();
    }
    
    public function listdata()
    {
        return $this->getCollection()
            ->getData();
        
    }
    public function getCollection()
    {
        return $this->_collection;
    }
}