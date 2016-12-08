<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Controller\Seller;

/**
 * Action : seller/view
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2016 Smile
 */
class View extends AbstractAction
{
    /**
     * Execute the action
     *
     * @return \Magento\Framework\View\Result\Page|null
     */
    public function execute()
    {
        // get the asked identifier
        $identifier = trim($this->getRequest()->getParam('identifier'));
        if (!$identifier) {
            $this->_forward('noroute');
            return null;
        }

        // get the asked seller
        try {
            $seller = $this->sellerRepository->getByIdentifier($identifier);
        } catch (\Exception $e) {
            $this->_forward('noroute');
            return null;
        }

        $this->registry->register('current_seller', $seller);

        // display the page using the layout
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Seller "%1"', $seller->getName()));

        return $resultPage;
    }
}
