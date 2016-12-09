<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/12/16
 * Time: 14:21
 */

namespace Training\Seller\Helper;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;
use Training\Seller\Api\SellerRepositoryInterface;

class Data extends AbstractHelper
{
    protected $searchCriteriaBuilder;
    protected $sellerRepositoryInterface;
    protected $filterBuilder;

    public function __construct(Context $context, SearchCriteriaBuilder $searchCriteriaBuilder,
                                SellerRepositoryInterface $sellerRepositoryInterface, FilterBuilder $filterBuilder)
    {
        parent::__construct($context);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sellerRepositoryInterface = $sellerRepositoryInterface;
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * @param ProductInterface $product
     * @return array
     */
    public function getProductsSellersIds(ProductInterface $product)
    {
        $sellerIds = $product->getData('training_seller_ids');
        return explode(',', $sellerIds);
    }

    /**
     * @param array $sellerIds
     * @return \Magento\Framework\Api\SearchCriteria
     */
    public function getSearchCriteriaOnSellerIds(array $sellerIds)
    {
        $filter = $this->filterBuilder
            ->setField('seller_id')
            ->setConditionType('in')
            ->setValue($sellerIds)
            ->create();
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilters(array($filter))
            ->create();
        return $searchCriteria;
    }

    /**
     * @param ProductInterface $product
     * @return \Training\Seller\Api\Data\SellerInterface[]
     */
    public function getProductSellers(ProductInterface $product)
    {
        return $this->sellerRepositoryInterface->getList(
            $this->getSearchCriteriaOnSellerIds(
                $this->getProductsSellersIds($product)
            )
        )->getItems();
    }
}