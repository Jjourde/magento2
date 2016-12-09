<?php

namespace Training\Seller\Block\Product;

use Magento\Catalog\Model\Product;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Training\Seller\Helper\Data;

class Sellers extends Template implements IdentityInterface
{
    protected $registry;
    protected $dataHelper;
    protected $sellers;

    public function __construct(Template\Context $context, Registry $registry, Data $dataHelper, array $data)
    {
        $this->registry = $registry;
        $this->dataHelper = $dataHelper;
        parent::__construct($context, $data);
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        $identities = array();
        $identities = $this->getCurrentProduct()->getIdentities();
        foreach($this->getProductSellers() as $seller) {
            $identities = array_merge($identities, $seller->getIdentities());
        }
        return $identities;
    }

    /**
     * Used to set the cache infos
     *
     * @return void
     */
    protected function _construct()
    {
        $product = $this->getCurrentProduct();
        if ($product) {
            $this->setData('cache_key', 'product_view_tab_sellers_' . $product->getId());
        }
    }

    /**
     * @return Product
     */
    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    /**
     * @return \Training\Seller\Api\Data\SellerInterface[]
     */
    public function getProductSellers()
    {
        if (!$this->sellers) {
            $this->sellers = $this->dataHelper->getProductSellers($this->getCurrentProduct());
        }
        return $this->sellers;
    }
}