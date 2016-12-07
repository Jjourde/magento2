<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 07/12/16
 * Time: 16:58
 */

namespace Training\Seller\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface SellerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get sellers list.
     *
     * @return SellerInterface[]
     */
    public function getItems();

    /**
     * Set attributes list.
     *
     * @param SellerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}