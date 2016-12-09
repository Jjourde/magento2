<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/12/16
 * Time: 11:55
 */

namespace Training\Seller\Setup;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Training\Seller\Option\Seller;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Product;

class UpgradeData implements UpgradeDataInterface
{
    protected $customerSetupFactory;
    protected $eavConfig;
    protected $productSetupFactory;

    public function __construct(CustomerSetupFactory $customerSetupFactory, Config $eavConfig,
                                EavSetupFactory $productSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->productSetupFactory = $productSetupFactory;
    }

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if(version_compare($context->getVersion(), '1.0.2', '<')) {
            /** @var CustomerSetup $customerSetup */
            $customerSetup = $this->customerSetupFactory->create(array('setup' => $setup));

            $customerSetup->addAttribute(
                Customer::ENTITY,
                'training_seller_id',
                array(
                    'type' => 'int',
                    'label' => 'Seller id',
                    'input' => 'select',
                    'source' => Seller::class,
                    'system' => false,
                    'required' => false
                )
            );
            $this->eavConfig->clear();

            $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'training_seller_id');
            $attribute->setData('used_in_forms', ['adminhtml_customer']);
            $attribute->save();

            $this->eavConfig->clear();
        }
        if(version_compare($context->getVersion(), '1.0.3', '<')) {
            /** @var EavSetup $productSetup */
            $productSetup = $this->productSetupFactory->create(array('setup' => $setup));

            //Product Details tab
            $productSetup->addAttribute(
                ProductAttributeInterface   ::ENTITY_TYPE_CODE,
                'training_seller_ids',
                array(
                    'type' => 'varchar',
                    'label' => 'Seller ids',
                    'input' => 'multiselect',
                    'source' => Seller::class,
                    'backend_type' => 'varchar',
                    'backend_model' => ArrayBackend::class,
                    'required' => false,
                    'user_defined' => true,
                    'default' => '',
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => true,
                    'visible_on_front' => true,
                    'used_in_product_listing' => false,
                    'is_html_allowed_on_front' => true,
                    'unique' => false,
                    'apply_to' => 'simple,configurable'
                )
            );

            $productSetup->addAttributeGroup(
                Product::ENTITY,
                'bag',
                'Training'
            );

            $productSetup->addAttributeToGroup(
                Product::ENTITY,
                'bag',
                'Training',
                'training_seller_ids'
            );

            $this->eavConfig->clear();
        }
        $setup->endSetup();
    }
}