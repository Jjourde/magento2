<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Helloworld\Controller\Product;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Action\Context;

/**
 * Action: Index/Index
 *
 * @author
Laurent MINGUET <lamin@smile.fr>
 * @copyright 2016 Smile
 */
class Search extends \Magento\Framework\App\Action\Action
{
    private $productRepositoryInterface;
    private $searchCriteriaBuilder;
    private $filterBuilder;
    private $sortOrderBuilder;

    public function __construct(Context $context, ProductRepositoryInterface $productRepositoryInterface,
                                SearchCriteriaBuilder $searchCriteriaBuilder, FilterBuilder $filterBuilder,
                                SortOrderBuilder $sortOrderBuilder)
    {
        parent::__construct($context);
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        $nameFilter = $this->filterBuilder
            ->setField(ProductInterface::NAME)
            ->setValue('%bruno%')
            ->setConditionType('like')
            ->create();
        $descriptionFilter = $this->filterBuilder
            ->setField('description')
            ->setValue('%comfortable%')
            ->setConditionType('like')
            ->create();
        $sortOrder = $this->sortOrderBuilder
            ->setField(ProductInterface::NAME)
            ->setDirection('DESC')
            ->create();
        $criteria = $this->searchCriteriaBuilder
            ->addFilters(array($nameFilter))
            ->addFilters(array($descriptionFilter))
            ->addSortOrder($sortOrder)
            ->setCurrentPage(1)
            ->setPageSize(6)
            ->create();
        $products = $this->productRepositoryInterface->getList($criteria)->getItems();

        foreach ($products as $product) {
            $this->getResponse()->appendBody($product->getName() . '<br />');
        }
    }
}