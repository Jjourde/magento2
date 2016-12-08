<?php

namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Training\Seller\Model\SellerFactory;

class Index extends Action
{

    protected $modelFactory;

    public function __construct(
        Context $context,
        SellerFactory $modelFactory
    ) {
        parent::__construct($context);

        $this->modelFactory = $modelFactory;
    }

    /**
     * Is it allowed ?
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Training_Seller::manage');
    }
    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        $seller = $this->modelFactory->create();
        $seller->getResource()->load($seller, 1);

        $this->getResponse()->appendBody('Seller: ' . $seller->getId() . ', ' . $seller->getIdentifier() . ', ' . $seller->getName() );
    }
}