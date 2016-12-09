<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/12/16
 * Time: 11:55
 */

namespace Training\Seller\Setup;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Config;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Training\Seller\Option\Seller;

class UpgradeData implements UpgradeDataInterface
{
    protected $customerSetupFactory;
    protected $eavConfig;

    public function __construct(CustomerSetupFactory $customerSetupFactory, Config $eavConfig)
    {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->eavConfig = $eavConfig;
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
        $setup->endSetup();
    }
}