<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Seller\Controller\Seller;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Context;
use Training\Seller\Api\Data\SellerSearchResultsInterface;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Model\Seller;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    private $sellerRepositoryInterface;
    private $searchCriteriaBuilder;
    private $registry;
    private $pageFactory;

    public function __construct(Context $context, SellerRepositoryInterface $sellerRepositoryInterface,
                                SearchCriteriaBuilder $searchCriteriaBuilder, Registry $registry,
                                PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->sellerRepositoryInterface = $sellerRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->registry = $registry;
        $this->pageFactory = $pageFactory;
    }

    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        $criteria = $this->searchCriteriaBuilder->create();
        /** @var SellerSearchResultsInterface $sellersSearchResult */
        $sellersSearchResult = $this->sellerRepositoryInterface->getList($criteria);

        $this->registry->register('sellers', $sellersSearchResult);

        return $this->pageFactory->create();
    }
}