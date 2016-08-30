<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 2/26/2016
 * Time: 12:55 PM
 */
namespace Perficient\Gallery\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'Gallery'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('perficient_gallery'))
            ->addColumn(
                'gallery_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Gallery Id'
            )
            ->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [],
                'Gallery Created At'
            )
            ->addColumn(
                'updated_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [],
                'Gallery Updated At'
            )
            ->addColumn(
                'store_ids',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Store Ids'
            )
            ->addColumn(
                'category_ids',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Category Ids'
            )
            ->addColumn(
                'image_ids',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Image Ides'
            )
            ->addColumn(
                'thombnail_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Thombnail Id'
            )
            ->addColumn(
                'gallery_code',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Gallery Code'
            )->addColumn(
                'gallery_description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Gallery Description'
            )->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'default' => '0'],
                'Status'
            )->setComment(
                'perficient_gallery'
            );
        $installer->getConnection()->createTable($table);


        /**
         * Create Trigger 'Designation Table to manage created_at and updated_at field'
         */
       /*  $insertGallery =
            <<<EOD
            CREATE TRIGGER `perficient_gallery_insert` 
                BEFORE INSERT ON `perficient_gallery` FOR EACH ROW 
                SET NEW.created_at =NOW();
EOD;
        $updateGallery = <<<EOD
            CREATE TRIGGER `perficient_gallery_update`
                BEFORE UPDATE ON `perficient_gallery` FOR EACH ROW 
                SET NEW.updated_at =NOW();
EOD;
        $installer->run($insertGallery);
        $installer->run($updateGallery);*/


        /**
         * Create table 'Gallery'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('perficient_gallery_images'))
            ->addColumn(
                'image_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Image Id'
            )->addColumn(
                'image_url',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Image Url'
            )->addColumn(
                'thombnail_url',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Thombnail Url'
            )->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                500,
                [],
                'Description'
            )
            ->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'default' => '0'],
                'Status'
            )->setComment(
                'perficient_gallery_images'
            );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();

    }
}