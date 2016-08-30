<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 3/9/2016
 * Time: 6:51 PM
 */
namespace Perficient\Faq\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
Use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements InstallSchemaInterface{

    public function install(SchemaSetupInterface $setup, ModuleDataSetupInterface $module){
        $installer=$setup;
        $installer->startSetup();
        $table=$installer->getConnection()
            ->newTable($intaller->getTable('perficient_faq'))
            ->addColumn(
                'faq_id',
                Table::TYPE_INTEGER,
                null,
                ['identity'=>true,'nullable'=>false,'primary'=>true],
                'Faq ID'
            )
            ->addColumn(
                'question',
                Table::TYPE_TEXT,
                null,
                'FAQ Question'
            );
    }
}