<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Seller\Controller\Seller;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Context;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Model\Seller;

class Index extends \Magento\Framework\App\Action\Action
{
    private $sellerRepositoryInterface;
    private $searchCriteriaBuilder;

    public function __construct(Context $context, SellerRepositoryInterface $sellerRepositoryInterface,
                                SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        parent::__construct($context);
        $this->sellerRepositoryInterface = $sellerRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        $criteria = $this->searchCriteriaBuilder->create();
        $sellers = $this->sellerRepositoryInterface->getList($criteria)->getItems();

        /** @var Seller $seller */
        $this->getResponse()->appendBody('<ul>');
        foreach ($sellers as $seller) {
            $this->getResponse()->appendBody('<li>Seller: ' . $seller->getId() . ', ' . $seller->getIdentifier() . ', ' . $seller->getName());
        }
        $this->getResponse()->appendBody('</ul>');
    }
}