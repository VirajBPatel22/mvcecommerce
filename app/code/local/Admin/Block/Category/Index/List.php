<?php
class Admin_Block_Category_Index_List extends Core_Block_Template{
    public function getCategory(){
        $category = Mage:: getModel('catalog/category')
        ->getCollection()
        ;
        $data = $category->getData();
        return $data;
    }
    
       
}


?>