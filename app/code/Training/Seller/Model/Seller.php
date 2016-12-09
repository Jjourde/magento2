<?php

/**
 * Created by PhpStorm.
 * User: formation
 * Date: 07/12/16
 * Time: 17:01
 */

namespace Training\Seller\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Model\ResourceModel\Seller as SellerResourceModel;

class Seller extends AbstractModel implements IdentityInterface, SellerInterface
{
    /**
     * Seller cache tag
     */
    const CACHE_TAG = 'training_seller';

    /**
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    public function _construct()
    {
        $this->_init(SellerResourceModel::class);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return array(self::CACHE_TAG.'_'.$this->getId());
    }

    /**
     * Get seller id
     *
     * @return null|int
     */
    public function getSellerId()
    {
        return $this->getId();
    }

    /**
     * Set seller id
     *
     * @param $id int
     * @return $this
     */
    public function setSellerId($id)
    {
        $this->setId($id);

        return $this;
    }

    /**
     * Get seller identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->getData(self::IDENTIFIER);
    }

    /**
     * Set seller identifier
     *
     * @param $identifier string
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->setData(self::IDENTIFIER, $identifier);
        return $this;
    }

    /**
     * Get seller name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set seller name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->setData(self::NAME, $name);
        return $this;
    }

    /**
     * Get seller description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * Set seller description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->setData(self::DESCRIPTION, $description);
        return $this;
    }

    /**
     * Get seller created at
     *
     * @return null|string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set seller created at
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData(self::CREATED_AT, $createdAt);
        return $this;
    }

    /**
     * Get seller updated at
     *
     * @return null|string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set seller updated at
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
        return $this;
    }
}