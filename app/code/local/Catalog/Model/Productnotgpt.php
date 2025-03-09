<?php
class Catalog_Model_Product extends Core_Model_Abstract
{
    public $status = [0 => 'disable', 1 => 'enable'];
    public function init()
    {
        $this->_resourceClassName = "Catalog_Model_Resource_Product";
        $this->_CollectionClassName = "Catalog_Model_Resource_Product_Collection";
    }
    public function getStatusText()
    {
        // if ()
        $condition = $this->getStatus();
        if (isset($this->status[$condition])) {
            return $this->status[$condition];
        } else {
            return "NA";
        }
    }
    protected function _afterLoad()
    {
        if ($this->getProductId()) {
            $collection = Mage::getModel("catalog/product_attribute")
                ->getcollection()
                ->addFieldToFilter("product_id", $this->getProductId())
                ->joinleft(
                    ["attr" => "catalog_attribute"],
                    "attr.attribute_id = main_table.attribute_id",
                    ["name" => "name"]
                );
            $data = $collection->getData();



            // die();
            foreach ($data as $_data) {
                $this->{$_data->getName()} = $_data->getValue();
            }
        }

        return $this;
    }
    protected function _afterSave()
    {

        $attributes = Mage::getModel('catalog/attribute')->getCollection()->getData();
        foreach ($attributes as $_attribute) {
            $productattributes = Mage::getModel('catalog/product_attribute')
                ->getCollection()
                ->addFieldToFilter('product_id', $this->getProductId())
                ->addFieldToFilter('attribute_id', $_attribute->getAttributeId())
                ->getData();

            $value = $this->{$_attribute->getName()};
            if (isset($productattributes[0])) {
                $productattributes[0]->setValue($value)
                    ->save();
            } else {
                Mage::getModel('catalog/product_attribute')
                    ->setAttributeId($_attribute->getAttributeId())
                    ->setProductId($this->getProductId())
                    ->setValue($value)
                    ->save();
            }
        }

        $mainImageName = isset($_POST['catalog_product']['main_image']) ? $_POST['catalog_product']['main_image'] : null;

        if (isset($_FILES['catalog_product']['name']['image'])) {
            $filesCount = count($_FILES['catalog_product']['name']['image']);
            for ($i = 0; $i < $filesCount; $i++) {
                $originalFileName = $_FILES['catalog_product']['name']['image'][$i];
                $file_path = $this->getProductId() . "_" . time() . "_" . $originalFileName;
                $tmp_name = $_FILES['catalog_product']['tmp_name']['image'][$i];
                $type = $_FILES['catalog_product']['type']['image'][$i];
                $type = substr($type, 0, strpos($type, '/'));

                $isMain = ($originalFileName == $mainImageName) ? 1 : 0;

                $product_image_data = [
                    "product_id"  => $this->getProductId(),
                    "file_path"   => "Media/Product/" . $file_path,
                    "type"        => $type,
                    "default_img" => $isMain
                ];

                $product_media = Mage::getModel("catalog/media");
                $product_media->setData($product_image_data);
                $piid = $product_media->save();

                if ($piid) {
                    move_uploaded_file($tmp_name, "Media/Product/" . $file_path);
                } else {
                    echo "File not uploaded.";
                }
            }
        }
    }
}
