<?php
namespace Perficient\RequestQuote\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Db\Ddl\Table;
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $tableName = $installer->getTable('perficient_quote');
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                        'default' => ''
                    ],
                    'Name'
                )->addColumn(
                    'email',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                        'default' => ''
                    ],
                    'Email'
                )
				->addColumn(
                    'phone',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                        'default' => ''
                    ],
                    'Phone'
                )
					->addColumn(
                    'company',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                        'default' => ''
                    ],
                    'Company'
                )
					->addColumn(
                    'message',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                        'default' => ''
                    ],
                    'Message'
                )
				->setComment('use for storing quote')
                ->setOption('type', 'innoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}