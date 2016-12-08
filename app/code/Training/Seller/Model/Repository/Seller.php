<?php

/**
 * Created by PhpStorm.
 * User: formation
 * Date: 08/12/16
 * Time: 09:47
 */

namespace Training\Seller\Model\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Api\Data\SellerSearchResultsInterface;
use Training\Seller\Api\SellerRepositoryInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\AbstractModel;

class Seller extends AbstractRepository implements SellerRepositoryInterface
{
    public function __construct(\Training\Seller\Model\SellerFactory $objectFactory,
                                \Training\Seller\Model\ResourceModel\Seller $objectResource,
                                \Training\Seller\Api\Data\SellerSearchResultsInterfaceFactory $searchResultsFactory)
    {
        parent::__construct($objectFactory, $objectResource, $searchResultsFactory);
        $this->setIdentifierFieldName(SellerInterface::IDENTIFIER);
    }

    /**
     * Get info about seller by seller_id
     *
     * @param int $sellerId
     * @return SellerInterface
     * @throws
     */
    public function getById($sellerId)
    {
        return $this->getEntityById($sellerId);
    }

    /**
     * Get info about seller by identifier
     *
     * @param string $identifier
     * @return SellerInterface
     * @throws NoSuchEntityException
     */
    public function getByIdentifier($identifier)
    {
        return $this->getEntityByIdentifier($identifier);
    }

    /**
     * Get seller list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SellerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        return $this->getEntities($searchCriteria);
    }

    /**
     * Create seller
     *
     * @param SellerInterface $seller
     * @return SellerInterface
     * @throws CouldNotSaveException
     */
    public function save(SellerInterface $seller)
    {
        return $this->saveEntity($seller);
    }

    /**
     * Delete seller by seller_id
     *
     * @param int $sellerId
     * @return bool Will returned True if deleted
     * @throws NoSuchEntityException
     */
    public function deleteById($sellerId)
    {
        $seller = $this->getEntityById($sellerId);
        return $this->deleteEntity($seller);
    }

    /**
     * Delete seller by identifier
     *
     * @param string $identifier
     * @return bool Will returned True if deleted
     * @throws NoSuchEntityException
     */
    public function deleteByIdentifier($identifier)
    {
        $seller = $this->getEntityByIdentifier($identifier);
        return $this->deleteEntity($seller);
    }
}