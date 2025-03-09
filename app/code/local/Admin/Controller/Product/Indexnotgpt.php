<?php

class Admin_Controller_Product_Index extends Core_Controller_Admin_Action
{
    // protected $_allowedActions =['new','list','save','delete'];
    public function newAction()
    {
        $product = Mage::getModel('catalog/product');
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('Admin/Product_Index_New')
            ->setTemplate('admin/product/index/new.phtml');
        $layout->getChild('content')->addChild('new', $view);
        $layout->toHtml();
    }

    public function listAction()
    {
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('Admin/Product_Index_List')
            ->setTemplate('admin/product/index/list.phtml');
        $layout->getChild('content')->addChild('list', $view);
        $layout->toHtml();
    }
    // public function saveAction()
    // {
    //     echo "<pre>";
    //     print_r($_POST);
    //     print_r($_FILES);
    //     echo "</pre>";
    //     die();
    //     $request = Mage::getModel("core/request");
    //     $data = $request->getParam('catalog_product');

    //     $name = substr($data["name"], 0, 5);
    //     $sku = $data["category_id"] . $name;
    //     $data["sku"] = $sku;

    //     // $pattributes = array_filter($request->getParam('catalog_product_attribute'));
    //     $product = Mage::getModel('catalog/product')->setData($data)->save();
    //     $id = $product->getProductId();
    //     echo "<pre>";
    //     print_r($id);
    //     echo "</pre>";
    //     // die();

    //     // $attributes = Mage::getModel('catalog/attribute');
    //     // $productattributes = Mage::getModel('catalog/product_attribute');
    //     // $product->setData($data);
    //     // $id = $product->save();
    //     // $product_id = $id->getProductId();
    //     // print_r($product_id);
    //     // $setAttribute = [];
    //     // if ($id) {
    //     //     foreach ($pattributes as $name => $value) {

    //     //         $attribute_data = $attributes->getCollection()->select('attribute_id')
    //     //             ->addFieldToFilter('name', ['=' => $name])->getData();


    //     //         if (!empty($attribute_data)) {
    //     //             $attribute_id = $attribute_data[0]->getAttributeId();

    //     //             $existingattribute = $productattributes->getCollection()
    //     //                 ->select()
    //     //                 ->addFieldToFilter('product_id', ['=' => $product_id])
    //     //                 ->addFieldToFilter('attribute_id', ['=' => $attribute_id]);
    //     //             $existingDatas = $existingattribute->getData();

    //     //             if (!empty($existingDatas)) {
    //     //                 $existdata = $existingDatas[0];
    //     //                 $setAttribute = [
    //     //                     "attribute_id" => $attribute_id,
    //     //                     "product_id" => $product_id,
    //     //                     "value" => $value,
    //     //                     "value_id" => $existdata->getValueId()
    //     //                 ];
    //     //             } else {
    //     //                 $setAttribute = [
    //     //                     "attribute_id" => $attribute_id,
    //     //                     "product_id" => $product_id,
    //     //                     "value" => $value,
    //     //                 ];
    //     //             }
    //     //             $productattributes->setData($setAttribute);


    //     //             $productattributes->save();
    //     //         }
    //     //     }
    //     // }
    //     if (isset($_FILES['catalog_product']['name']['image'])) {
    //         for ($i = 0; $i < count($_FILES['catalog_product']['name']['image']); $i++) {
    //             // echo $_FILES['catalog_product']['name']['image'][$i];
    //             $file_path = $product_id . "" . time() . "" . $_FILES['catalog_product']['name']['image'][$i];
    //             $tmp_name = $_FILES['catalog_product']['tmp_name']['image'][$i];
    //             $type = $_FILES['catalog_product']['type']['image'][$i];
    //             $type = substr($type, 0, strpos($type, '/'));

    //             $product_image_data = [
    //                 "product_id" => $product_id,
    //                 "file_path" => "Media/Product/" . $file_path,
    //                 "type" =>  $type
    //             ];

    //             $product_media = Mage::getModel("catalog/media");
    //             $product_media->setData($product_image_data);
    //             $piid = $product_media->save();

    //             if ($piid) {
    //                 move_uploaded_file($tmp_name, "Media/Product/" . $file_path);
    //             } else {
    //                 echo "File not uploaded.";
    //             }
    //         }
    //     }

    //     echo $url = Mage::getBaseUrl() . $request->getModuleName() . "/" . $request->getControllerName() . "/list";
    //     header("location: {$url}");
    //     exit();
    // }
    public function saveAction()
    {
        $request = Mage::getModel("core/request");
        $data = $request->getParam('catalog_product');

        // Create SKU based on category_id and a substring of the name.
        $name = substr($data["name"], 0, 5);
        $sku = $data["category_id"] . $name;
        $data["sku"] = $sku;

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        $product = Mage::getModel('catalog/product')->setData($data)->save();
        // $productId = $product->getProductId();

        // // Get the selected main image name from the form post.
        // $mainImageName = isset($_POST['catalog_product']['main_image']) ? $_POST['catalog_product']['main_image'] : null;

        // // Process uploaded images and set default_img accordingly.
        // if (isset($_FILES['catalog_product']['name']['image'])) {
        //     $filesCount = count($_FILES['catalog_product']['name']['image']);
        //     for ($i = 0; $i < $filesCount; $i++) {
        //         $originalFileName = $_FILES['catalog_product']['name']['image'][$i];
        //         $file_path = $productId . "_" . time() . "_" . $originalFileName;
        //         $tmp_name = $_FILES['catalog_product']['tmp_name']['image'][$i];
        //         $type = $_FILES['catalog_product']['type']['image'][$i];
        //         $type = substr($type, 0, strpos($type, '/'));

        //         // Mark this image as the cover if its file name matches the selected main image.
        //         $isMain = ($originalFileName == $mainImageName) ? 1 : 0;

        //         $product_image_data = [
        //             "product_id"  => $productId,
        //             "file_path"   => "Media/Product/" . $file_path,
        //             "type"        => $type,
        //             "default_img" => $isMain
        //         ];

        //         $product_media = Mage::getModel("catalog/media");
        //         $product_media->setData($product_image_data);
        //         $piid = $product_media->save();

        //         if ($piid) {
        //             move_uploaded_file($tmp_name, "Media/Product/" . $file_path);
        //         } else {
        //             echo "File not uploaded.";
        //         }
        //     }
        // }

        // Redirect to the product list page.
        $url = Mage::getBaseUrl() . $request->getModuleName() . "/" . $request->getControllerName() . "/list";
        header("location: {$url}");
        exit();
    }


    public function deleteAction()
    {
        $request = Mage::getModel("core/request");
        $product = Mage::getModel('catalog/product');
        // //print_r($_POST['catalog_product']);
        $id = $request->getQuery('id');
        $product->load($id);
        $product->delete();
        header("Location: http://localhost/ecommerecemvc/admin/product_index/list");
        $layout =  Mage::getBlock('core/layout');
        $view = $layout->createBlock('Admin/Product_Index_Delete')
            ->setTemplate('admin/product/index/delete.phtml');
        $layout->getChild('content')->addChild('delete', $view);
        $layout->toHtml();
    }
}
