<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-07-04 22:42:27
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-07-05 08:34:51
 * @website: http://giaphugroup.com
 */

namespace PHPCuong\CustomerProfilePicture\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
    /**
     * Eav setup factory
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function uninstall(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->removeAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'profile_picture'
        );
        $setup->endSetup();
    }
}

