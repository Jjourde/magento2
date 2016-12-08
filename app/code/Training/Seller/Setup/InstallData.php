<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 08/12/16
 * Time: 10:29
 */

namespace Training\Seller\Setup;


use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Model\Seller;

class InstallData implements InstallDataInterface
{
    protected $objectManagerInterface;

    public function __construct(ObjectManagerInterface $objectManagerInterface)
    {
        $this->objectManagerInterface = $objectManagerInterface;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var Seller $seller */
        $seller = $this->objectManagerInterface->create(SellerInterface::class);
        $seller
            ->setIdentifier('main')
            ->setName('Main');
        $seller->getResource()->save($seller);
    }
}