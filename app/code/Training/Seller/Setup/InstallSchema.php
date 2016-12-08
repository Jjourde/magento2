<?php

/**
 * Created by PhpStorm.
 * User: formation
 * Date: 08/12/16
 * Time: 10:09
 */

namespace Training\Seller\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Training\Seller\Api\Data\SellerInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $table = $setup->getConnection()->newTable(
            $setup->getTable('training_seller')
        )->addColumn(
            SellerInterface::SELLER_ID,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Seller id'
        )->addColumn(
            SellerInterface::IDENTIFIER,
            Table::TYPE_TEXT,
            64,
            ['nullable' => false],
            'Seller identifier'
        )->addColumn(
            SellerInterface::NAME,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Seller name'
        )->addColumn(
            SellerInterface::CREATED_AT,
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Seller created at'
        )->addColumn(
            SellerInterface::UPDATED_AT,
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Seller updated at'
        )->addIndex(
            $setup->getIdxName($setup->getTable('training_seller'), SellerInterface::IDENTIFIER),
            SellerInterface::IDENTIFIER
        );
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}