<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Seller\Controller\Seller;

use Magento\Framework\App\Action\Context;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Model\Seller;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class View extends \Magento\Framework\App\Action\Action
{
    private $sellerRepositoryInterface;
    private $registry;
    private $pageFactory;

    public function __construct(Context $context, SellerRepositoryInterface $sellerRepositoryInterface,
                                Registry $registry, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->sellerRepositoryInterface = $sellerRepositoryInterface;
        $this->registry = $registry;
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $identifier = $this->getRequest()->getParam('identifier');

        /** @var Seller $seller */
        $seller = $this->sellerRepositoryInterface->getByIdentifier($identifier);

        $this->registry->register('seller', $seller);

        return $this->pageFactory->create();
    }
}