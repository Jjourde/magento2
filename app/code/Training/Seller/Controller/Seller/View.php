<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Seller\Controller\Seller;

use Magento\Framework\App\Action\Context;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Model\Seller;

class View extends \Magento\Framework\App\Action\Action
{
    private $sellerRepositoryInterface;

    public function __construct(Context $context, SellerRepositoryInterface $sellerRepositoryInterface)
    {
        parent::__construct($context);
        $this->sellerRepositoryInterface = $sellerRepositoryInterface;
    }

    public function execute()
    {
        $identifier = $this->getRequest()->getParam('identifier');

        /** @var Seller $seller */
        $seller = $this->sellerRepositoryInterface->getByIdentifier($identifier);

        $this->getResponse()->appendBody('Seller: ' . $seller->getId() . ', ' . $seller->getIdentifier() . ', ' . $seller->getName() );
    }
}