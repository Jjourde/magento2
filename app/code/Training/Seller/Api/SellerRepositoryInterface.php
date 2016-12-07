<?php

namespace Training\Seller\Api;

use \Magento\Framework\Api\SearchCriteriaInterface;
use \Training\Seller\Api\Data\SellerSearchResultsInterface;
use \Training\Seller\Api\Data\SellerInterface;
use \Magento\Framework\Exception\NoSuchEntityException;
use \Magento\Framework\Exception\CouldNotSaveException;

interface SellerRepositoryInterface
{
    /**
     * Get info about seller by seller_id
     *
     * @param int $sellerId
     * @return SellerInterface
     * @throws
     */
    public function getById($sellerId);

    /**
     * Get info about seller by identifier
     *
     * @param string $identifier
     * @return SellerInterface
     * @throws NoSuchEntityException
     */
    public function getByIdentifier($identifier);

    /**
     * Get seller list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SellerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Create seller
     *
     * @param SellerInterface $seller
     * @return SellerInterface
     * @throws CouldNotSaveException
     */
    public function save(SellerInterface $seller);

    /**
     * Delete seller by seller_id
     *
     * @param int $sellerId
     * @return bool Will returned True if deleted
     * @throws NoSuchEntityException
     */
    public function deleteById($sellerId);

    /**
     * Delete seller by identifier
     *
     * @param string $identifier
     * @return bool Will returned True if deleted
     * @throws NoSuchEntityException
     */
    public function deleteByIdentifier($identifier);
}