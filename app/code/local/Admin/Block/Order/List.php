<?php
class Admin_Block_Order_List extends Admin_Block_Widget_Grid{
    protected $_collection;
    public function __construct()
    {
        $this->addColumns('order_id', [
            'render' => 'number',
            'filter' => 'Number',
            'data_index' => 'order_id',
            'lable' => 'order id',
        ]);
        $this->addColumns('customer_id', [
            'render' => 'number',
            'filter' => 'Number',
            'data_index' => 'customer_id',
            'lable' => 'customer id',
        ]);
        $this->addColumns('email', [
            'render' => 'text',
            'filter' => 'Text',
            'data_index' => 'email',
            'lable' => 'email',
        ]);
        $this->addColumns('order_status', [
            'render' => 'dropdown',
            'filter' => 'Dropdown',
            'filter_option' => ['pending','shipped','delivered','cancelled'],
            'data_index' => 'order_status',
            'lable' => 'order status',
        ]);
        $this->addColumns('total_amount', [
            'render' => 'number',
            'filter' => 'Number',
            'data_index' => 'total_amount',
            'lable' => 'total amount',
        ]);
        // $this->addColumns('Description', [
        //     'render' => 'text',
        //     'filter' => 'Text',
        //     'data_index' => 'description',
        //     'lable' => 'product description',
        // ]);
        // $this->addColumns('sku', [
        //     'render' => 'text',
        //     'filter' => 'Text',
        //     'data_index' => 'sku',
        //     'lable' => 'sku',
        // ]);
        // $this->addColumns('price', [
        //     'render' => 'number',
        //     'filter' => 'Number',
        //     'data_index' => 'price',
        //     'lable' => 'price',
        // ]);
        // $this->addColumns('stock_quantity', [
        //     'render' => 'number',
        //     'filter' => 'Number',
        //     'data_index' => 'stock_quantity',
        //     'lable' => 'stock Quantity',
        // ]);
        // $this->addColumns('category name', [
        //     'render' => 'text',
        //     'filter' => 'Text',
        //     'data_index' => 'category_name',
        //     'lable' => 'category name',
        // ]);
        // $this->addColumns('color', [
        //     'render' => 'text',
        //     'filter' => 'Text',
        //     'data_index' => 'color',
        //     'lable' => 'color',
        // ]);
        // $this->addColumns('material', [
        //     'render' => 'text',
        //     'filter' => 'Text',
        //     'data_index' => 'material',
        //     'lable' => 'material',
        // ]);
        
        $this->addColumns('view', [
            'filter' => 'view',
            'columns' => 'Link',
            'callback'=>'getview',
            'primary_key' => 'order_id',
            'data_index' => 'view',
            'lable' => 'view',
        ]);
        
        $this->setCollection( Mage::getModel('sale/order')
        ->getCollection());
        parent :: __construct();

        $this->init();
    }
    public function getview($data){
        return $this->getUrl('*/*/view').'/?order_id='.$data['order_id'];
    }
    public function init()
    {
        $layout = $this->getLayout();
        $toolbar_block = $layout->createBlock("Admin/grid_toolbar")
            ->setTemplate("admin/grid/toolbar.phtml");

        $product = Mage::getModel("sale/order");
        $this->addChild("toolbar", $toolbar_block);


        $this->_collection = $product->getCollection();
            // ->joinleft(["cc" => "catalog_category"], " cc.category_id = main_table.category_id ", ["category_name" => "name"])
            // ->addAttributeToSelect(["color", "material", "size"]);

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


//     public function getOrderData(){
//         $orderData = Mage::getModel("sale/order")
//             ->getCollection()
//             ->getData();
//         return $orderData;
//     }
//     protected $_collection;
//     public function __construct()
//     {

//         $this->init();
//     }
//     public function init()
//     {
//         $layout=$this->getLayout();
//         $toolbar_block=$layout->createBlock("Admin/grid_toolbar")
//                         ->setTemplate("admin/grid/toolbar.phtml");
        
//         $product = Mage::getModel("sale/order");
//        $this->addChild("toolbar",$toolbar_block);
    

//         $this->_collection = $product->getCollection();
        
//         $toolbar_block->prepareToolbar();
//     }
    
//     public function listdata()
//     {
//         return $this->getCollection()
//             ->getData();
        
//     }
//     public function getCollection()
//     {
//         return $this->_collection;
//     }
        
}

?>