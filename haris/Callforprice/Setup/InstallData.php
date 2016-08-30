<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/26/2016
 * Time: 3:48 PM
 */
namespace Perficient\Callforprice\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{

    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {

        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        /**
         * @var
         * EavSetup
         * $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        /**
         *
         * Add attributes to the eav/attribute
         */
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'call_for_free',
            [

                'group' => 'General',

                'type' => 'int',

                'backend' => '',

                'frontend' => '',

                'label' => 'Call for price',

                'input' => 'boolean',

                'class' => '',

                'source' => '',

                'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,

                'visible' => true,

                'required' => true,

                'user_defined' => false,

                'default' => '',

                'searchable' => true,
                
                'is_user_defined' => true,

                'filterable' => true,

                'comparable' => false,

                'visible_on_front' => true,

                'used_in_product_listing' => true,

                'is_used_in_grid' => true,

                'is_filterable_in_grid' => true,

                'unique' => false

            ]

        );

    }
}