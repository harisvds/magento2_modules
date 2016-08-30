<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/20/2016
 * Time: 5:25 PM
 */
namespace Perficient\Office\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup,
                            ModuleContextInterface $context)
    {
        $setup->startSetup();
        /* #snippet1 */
        $employeeEntityTable = \Perficient\Office\Model\Employee::ENTITY. '_entity';
        $departmentEntityTable = 'perficient_office_department';
        $setup->getConnection()
            ->addForeignKey(
                $setup->getFkName($employeeEntityTable, 'department_id',
                    $departmentEntityTable, 'entity_id'),
                $setup->getTable($employeeEntityTable),
                'department_id',
                $setup->getTable($departmentEntityTable),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );

        $setup->endSetup();
    }
}