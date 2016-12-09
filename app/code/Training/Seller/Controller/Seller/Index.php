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

    /**
     * Get the search criteria
     *
     * @return \Magento\Framework\Api\SearchCriteria
     */
    protected function getSearchCriteria()
    {
        // get the asked filter name, with protection
        $searchName = (string) $this->_request->getParam('search_name', '');
        $searchName = strip_tags($searchName);
        $searchName = preg_replace('/[\'"%]/', '', $searchName);
        $searchName = trim($searchName);

        // build the filter, if needed, and add it to the criteria
        if ($searchName!== '') {
            // build the filter for the name
            $filters[] = $this->filterBuilder
                ->setField(SellerInterface::FIELD_NAME)
                ->setConditionType('like')
                ->setValue("%$searchName%")
                ->create();

            // add the filter to the criteria
            $this->searchCriteriaBuilder->addFilters($filters);
        }

        // get the asked sort order, with protection
        $sortOrder = (string) $this->_request->getParam('sort_order');
        $availableSort = [
            SortOrder::SORT_ASC,
            SortOrder::SORT_DESC,
        ];
        if (!in_array($sortOrder, $availableSort)) {
            $sortOrder = $availableSort[0];
        }

        // build the sort order and add it to the criteria
        $sort = $this->sortOrderBuilder
            ->setField(SellerInterface::FIELD_NAME)
            ->setDirection($sortOrder)
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sort);

        // build the criteria
        return $this->searchCriteriaBuilder->create();
    }
}