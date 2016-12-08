<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Controller\Seller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Result\PageFactory as ResultPageFactory;
use Training\Seller\Model\Repository\Seller as SellerRepository;

/**
 * Controller abstract
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2016 Smile
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
abstract class AbstractAction extends Action
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var ResultPageFactory
     */
    protected $resultPageFactory;

    /**
     * @var SellerRepository
     */
    protected $sellerRepository;

    /**
     * @var FilterBuilder
     */
    protected $filterBuilder;

    /**
     * @var SortOrderBuilder
     */
    protected $sortOrderBuilder;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * PHP Constructor
     *
     * @param Context               $context
     * @param Registry              $registry
     * @param ResultPageFactory     $resultPageFactory
     * @param SellerRepository      $sellerRepository
     * @param FilterBuilder         $filterBuilder
     * @param SortOrderBuilder      $sortOrderBuilder
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        Context               $context,
        Registry              $registry,
        ResultPageFactory     $resultPageFactory,
        SellerRepository      $sellerRepository,
        FilterBuilder         $filterBuilder,
        SortOrderBuilder      $sortOrderBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->registry              = $registry;
        $this->resultPageFactory     = $resultPageFactory;
        $this->sellerRepository      = $sellerRepository;
        $this->filterBuilder         = $filterBuilder;
        $this->sortOrderBuilder      = $sortOrderBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

        parent::__construct($context);
    }
}
