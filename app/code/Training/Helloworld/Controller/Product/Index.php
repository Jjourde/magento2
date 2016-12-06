<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Helloworld\Controller\Product;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\Action\Context;

/**
 * Action: Index/Index
 *
 * @author
Laurent MINGUET <lamin@smile.fr>
 * @copyright 2016 Smile
 */
class Index extends \Magento\Framework\App\Action\Action
{
    private $productFactory;

    public function __construct(Context $context, ProductFactory $productFactory)
    {
        parent::__construct($context);
        $this->productFactory = $productFactory;
    }

    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        $productId = $this->getRequest()->getParam('id');
        $product = $this->productFactory->create()->load($productId);

        $this->getResponse()->appendBody(($product && $product->getId() ? $product->getName() : 'Failed !'));
    }
}