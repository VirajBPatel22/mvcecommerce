<?php

Class Admin_Controller_Index extends Core_Controller_Admin_Action{
    public function IndexAction(){

        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('Admin/Index')
        ->setTemplate('admin/index.phtml');
        $layout->getChild('content')->addChild('index', $view);
        $layout->toHtml();
    }
    
}


?>