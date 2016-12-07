<?php

/**
 * Created by PhpStorm.
 * User: formation
 * Date: 07/12/16
 * Time: 17:13
 */

namespace Training\Seller\Model\ResourceModel;

use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\DB\Select;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\Context;

abstract class AbstractResource extends AbstractDb
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * @var string
     */
    protected $interfaceName;

    /**
     * @param Context $context
     * @param EntityManager $entityManager
     * @param MetadataPool $metadataPool
     * @param string $connectionName
     */
    public function __construct(
        Context $context,
        EntityManager $entityManager,
        MetadataPool $metadataPool,
        $interfaceName,
        $connectionName = null
    ) {
        $this->entityManager = $entityManager;
        $this->metadataPool = $metadataPool;
        $this->$interfaceName = $interfaceName;
        parent::__construct($context, $connectionName);
    }

    /**
     * Get connection
     *
     * @return \Magento\Framework\DB\Adapter\AdapterInterface
     * @throws \Exception
     */
    public function getConnection()
    {
        return $this->metadataPool->getMetadata($this->interfaceName)->getEntityConnection();
    }

    /**
     * @param AbstractModel $object
     * @param mixed $value
     * @param null $field
     * @return bool|int|string
     * @throws LocalizedException
     * @throws \Exception
     */
    private function getDbObjectId(AbstractModel $object, $value, $field = null)
    {
        $entityMetadata = $this->metadataPool->getMetadata($this->interfaceName);
        if (!is_numeric($value) && $field === null) {
            $field = 'identifier';
        } elseif (!$field) {
            $field = $entityMetadata->getIdentifierField();
        }
        $entityId = $value;
        if ($field != $entityMetadata->getIdentifierField()) {
            $select = $this->_getLoadSelect($field, $value, $object);
            $select->reset(Select::COLUMNS)
                ->columns($this->getMainTable() . '.' . $entityMetadata->getIdentifierField())
                ->limit(1);
            $result = $this->getConnection()->fetchCol($select);
            $entityId = count($result) ? $result[0] : false;
        }
        return $entityId;
    }

    /**
     * Load an object
     *
     * @param AbstractModel $object
     * @param mixed $value
     * @param string $field field to load by (defaults to model id)
     * @return $this
     */
    public function loadWithEntityManager(AbstractModel $object, $value, $field = null)
    {
        $objectId = $this->getDbObjectId($object, $value, $field);
        if ($objectId) {
            $this->entityManager->load($object, $objectId);
        }
        return $this;
    }

    /**
     * Save object
     * 
     * @param AbstractModel $object
     * @return $this
     * @throws \Exception
     */
    public function saveWithEntityManager(AbstractModel $object)
    {
        $this->entityManager->save($object);
        return $this;
    }

    /**
     * Delete object
     *
     * @param AbstractModel $object
     * @return $this
     * @throws \Exception
     */
    public function deleteWithEntityManager(AbstractModel $object)
    {
        $this->entityManager->delete($object);
        return $this;
    }
}