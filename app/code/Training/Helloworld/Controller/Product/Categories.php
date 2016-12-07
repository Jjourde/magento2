<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Helloworld\Controller\Product;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Framework\App\Action\Context;

/**
 * Action: Index/Index
 *
 * @author
Laurent MINGUET <lamin@smile.fr>
 * @copyright 2016 Smile
 */
class Categories extends \Magento\Framework\App\Action\Action
{
    protected $productCollectionFactory;
    protected $categoryCollectionFactory;

    public function __construct(Context $context, ProductCollectionFactory $productCollectionFactory,
                                CategoryCollectionFactory $categoryCollectionFactory)
    {
        parent::__construct($context);
        $this->productCollectionFactory = $productCollectionFactory;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
    }

    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        $products = $this->productCollectionFactory->create()
            ->addAttributeToFilter('name', array('like' => '%bag%'))
            ->addAttributeToSelect('*')
            ->addCategoryIds();
        $categoryIds = $cats = array();

        /** @var Product $product */
        foreach($products as $product) {
            $categoryIds = array_merge($categoryIds, $product->getCategoryIds());
        }
        $categoryIds = array_unique($categoryIds);

        $categories = $this->categoryCollectionFactory->create()
            ->addFieldToFilter('entity_id', array('in' => $categoryIds))
            ->addAttributeToSelect('*');

        /** @var Category $category */
        foreach($categories as $category) {
            $cats[$category->getId()] = $category->getName();
        }

        $this->getResponse()->appendBody('<ul>');
        foreach($products as $product) {
            $this->
            $this->getResponse()->appendBody('<li>Product : ' . $product->getName() . '<ul>');
            foreach($product->getCategoryIds() as $categoryId) {
                $this->getResponse()->appendBody('<li>Category : ' . $cats[$categoryId] . '</li>');
            }
            $this->getResponse()->appendBody('</ul></li>');
        }
        $this->getResponse()->appendBody('</ul>');
    }
}