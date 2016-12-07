<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 07/12/16
 * Time: 17:51
 */

namespace Training\Seller\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Training\Seller\Api\Data\SellerInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use \Magento\Framework\Model\AbstractModel;


class Seller extends AbstractResource
{
    protected $dateTime;

    public function __construct(Context $context, EntityManager $entityManager, MetadataPool $metadataPool,
                                $connectionName, DateTime $dateTime)
    {
        parent::__construct($context, $entityManager, $metadataPool, SellerInterface::class, $connectionName);
        $this->dateTime = $dateTime;
    }

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('training_seller', SellerInterface::SELLER_ID);
    }

    /**
     * Load seller
     *
     * @param AbstractModel $object
     * @param mixed $value
     * @param null $field
     * @return $this
     */
    public function load(AbstractModel $object, $value, $field = null)
    {
        return $this->loadWithEntityManager($object, $value, $field);
    }

    /**
     * Delete seller
     *
     * @param AbstractModel $object
     * @return $this
     */
    public function delete(AbstractModel $object)
    {
        return $this->deleteWithEntityManager($object);
    }

    /**
     * @param AbstractModel $object
     * @return $this
     */
    protected function _beforeSave(AbstractModel $object)
    {
        $date = $this->dateTime->gmtDate();

        if (!$object->getId()) {
            $object->setData(SellerInterface::CREATED_AT, $date);
        }
        $object->setData(SellerInterface::UPDATED_AT, $date);

        return parent::_beforeSave($object);
    }

    /**
     * @param array $ids
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteIds(array $ids)
    {
        $condition = $this->getConnection()->quoteInto($this->getIdFieldName() . ' IN (?)', (array) $ids);
        $this->getConnection()->delete($this->getMainTable(), $condition);

        return $this;
    }
}