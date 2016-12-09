<?php

namespace Training\Seller\Option;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Training\Seller\Model\ResourceModel\Seller\CollectionFactory;

class Seller extends AbstractSource
{
    protected $collectionFactory;
    protected $options;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getOptions()
    {
        if (!$this->options) {
            $this->options = $this->collectionFactory->create()->toOptionArray();
        }
        return $this->options;
    }

    public function getAllOptions()
    {
        return $this->getOptions();
    }
}