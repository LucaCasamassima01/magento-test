<?php

declare(strict_types=1);

namespace Codestorm\FakePim\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddPimUpdatedAtAttribute implements DataPatchInterface
{
    public function __construct(
        private ModuleDataSetupInterface $moduleDataSetup,
        private EavSetupFactory $eavSetupFactory
    ) {
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create([
            'setup' => $this->moduleDataSetup
        ]);

        $eavSetup->addAttribute(
            Product::ENTITY,
            'pim_updated_at',
            [
                'type' => 'datetime',
                'label' => 'PIM Last Update',
                'input' => 'date',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'global' => 1,
                'visible_on_front' => false,
                'used_in_product_listing' => false,
                'group' => 'General'
            ]
        );

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}