<?php


namespace Training\Seller\Plugin\Model;

use Magento\Catalog\Api\Data\ProductExtensionFactory;
use Training\Seller\Helper\Data;

class Product
{
    protected $dataHelper;
    protected $productExtensionFactory;

    /**
     * Product constructor.
     * @param Data $dataHelper
     * @param ProductExtensionFactory $productExtensionFactory
     */
    public function __construct(Data $dataHelper, ProductExtensionFactory $productExtensionFactory)
    {
        $this->dataHelper = $dataHelper;
        $this->productExtensionFactory = $productExtensionFactory;
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @return \Magento\Catalog\Model\Product
     */
    public function afterLoad(\Magento\Catalog\Model\Product $product)
    {
        $productExtension = $product->getExtensionAttributes();
        if ($productExtension === null) {
            $productExtension = $this->productExtensionFactory->create();
        }
        // stockItem := \Magento\CatalogInventory\Api\Data\StockItemInterface
        $productExtension->setSellers($this->dataHelper->getProductSellers($product));
        $product->setExtensionAttributes($productExtension);
        return $product;
    }
}