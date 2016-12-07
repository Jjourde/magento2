<?php

/**
 * Created by PhpStorm.
 * User: formation
 * Date: 07/12/16
 * Time: 18:05
 */

namespace Training\Seller\Model\ResourceModel\Seller;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Model\Seller;
use Training\Seller\Model\ResourceModel\Seller as SellerResourceModel;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Seller::class, SellerResourceModel::class);
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return parent::_toOptionArray(SellerInterface::SELLER_ID, SellerInterface::NAME);
    }
}