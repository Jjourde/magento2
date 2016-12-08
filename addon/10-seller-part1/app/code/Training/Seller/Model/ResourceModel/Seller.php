<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Model\ResourceModel;

use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Training\Seller\Api\Data\SellerInterface;

/**
 * Seller Resource Model
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2016 Smile
 */
class Seller extends AbstractDb
{
    use TraitResource;

    /**
     * Core date model
     *
     * @var DateTime
     */
    protected $date;

    /**
     * Class constructor
     *
     * @param Context       $context
     * @param EntityManager $entityManager
     * @param MetadataPool  $metadataPool
     * @param DateTime      $date
     * @param string        $connectionName
     */
    public function __construct(
        Context       $context,
        EntityManager $entityManager,
        MetadataPool  $metadataPool,
        DateTime      $date,
        $connectionName = null
    ) {
        $this->date          = $date;

        parent::__construct($context, $connectionName);

        $this->constructTrait(
            $entityManager,
            $metadataPool,
            SellerInterface::class,
            $this->_mainTable,
            $this->_idFieldName
        );
    }

    /**
     * Magento Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(SellerInterface::TABLE_NAME, SellerInterface::FIELD_SELLER_ID);
    }

    /**
     * Load an object
     *
     * @param AbstractModel $object
     * @param mixed         $value
     * @param string        $field field to load by (defaults to model id)
     *
     * @return $this
     * @throws \Exception
     */
    public function load(AbstractModel $object, $value, $field = null)
    {
        return $this->loadWithEntityManager($object, $value, $field);
    }

    /**
     * Save an object
     *
     * @param AbstractModel $object
     *
     * @return $this
     * @throws \Exception
     */
    public function save(AbstractModel $object)
    {
        return $this->saveWithEntityManager($object);
    }

    /**
     * Delete an object
     *
     * @param AbstractModel $object
     *
     * @return $this
     * @throws \Exception
     */
    public function delete(AbstractModel $object)
    {
        return $this->deleteWithEntityManager($object);
    }

    /**
     * @inheritdoc
     */
    protected function _beforeSave(AbstractModel $object)
    {
        $date = $this->date->gmtDate();

        if (!$object->getId()) {
            $object->setData(SellerInterface::FIELD_CREATED_AT, $date);
        }
        $object->setData(SellerInterface::FIELD_UPDATED_AT, $date);

        return parent::_beforeSave($object);
    }

    /**
     * delete a list of entities by the ids
     *
     * @param int[] $ids ids to delete
     *
     * @return Seller
     */
    public function deleteIds($ids)
    {
        $condition = $this->getConnection()->quoteInto($this->getIdFieldName() . ' IN (?)', (array) $ids);
        $this->getConnection()->delete($this->getMainTable(), $condition);

        return $this;
    }
}
