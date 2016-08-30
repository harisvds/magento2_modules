<?php
/**
 * This will create database tables(perficient_employee, perficient_department, perficient_designation) and make the association also creat the database triggers to manage created_at/updated_at fields.
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 4:46 PM
 */

namespace Perficient\Core\Setup;

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
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'Department'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('perficient_department'))
            ->addColumn(
                'department_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true,
                    'nullable' => false, 'primary' => true],
                'Department Id'
            )
            ->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [],
                'Department Created At'
            )
            ->addColumn(
                'updated_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [],
                'Department Updated At'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Depart Name'
            )
            ->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '2M',
                ['nullable' => true, 'default' => null],
                'Department Description'
            )
            ->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'default' => '1'],
                'Status'
            )->setComment(
                'Perficient Department Table For Storing Department Detail'
            );
        $installer->getConnection()->createTable($table);

        /**
         * Create Trigger for 'Department Table to manage created_at and updated_at field'
         */
        /*$insertDepartment = <<<EOD
            CREATE TRIGGER `department_insert` 
                BEFORE INSERT ON `perficient_department` FOR EACH ROW 
                SET NEW.created_at =NOW();
EOD;
        $updateDepartment = <<<EOD
            CREATE TRIGGER `department_update`
                BEFORE UPDATE ON `perficient_department` FOR EACH ROW 
                SET NEW.updated_at =NOW();
EOD;


        $installer->run($insertDepartment);
        $installer->run($updateDepartment);*/


        /**
         * Create table 'Designations   '
         */

        if (!$installer->tableExists('perficient_designation')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('perficient_designation'))
                ->addColumn(
                    'designation_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Designations Id'
                )
                ->addColumn(
                    'department_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false,
                    ],
                    'Department Id'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Department Created At'
                )
                ->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Department Updated At'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Designations  Name'
                )
                ->addColumn(
                    'description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '2M',
                    ['nullable' => true, 'default' => null],
                    'Designations Description'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false, 'default' => '1'],
                    'Status'
                )
                ->setComment(
                    'Designation Table For Storing Designation Detail'
                );

            $installer->getConnection()->createTable($table);
        }

        /**
         * Create Trigger 'Designation Table to manage created_at and updated_at field'
         */
         /*$insertDesignation =
            <<<EOD
            CREATE TRIGGER `designation_insert` 
                BEFORE INSERT ON `perficient_designation` FOR EACH ROW 
                SET NEW.created_at =NOW();
EOD;
        $updateDesignation = <<<EOD
            CREATE TRIGGER `designation_update`
                BEFORE UPDATE ON `perficient_designation` FOR EACH ROW 
                SET NEW.updated_at =NOW();
EOD;
        $installer->run($insertDesignation);
        $installer->run($updateDesignation);*/


        /**
         * Create table 'Employee   '
         */


        if (!$installer->tableExists('perficient_employee')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('perficient_employee'))
                ->addColumn(
                    'employee_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Employee Id'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Department Created At'
                )
                ->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Department Updated At'
                )
                ->addColumn(
                    'designation_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        //'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,


                    ],
                    'Designation Id'
                )
                ->addColumn(
                    'department_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        //'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,


                    ],
                    'Department Id'
                )
                ->addColumn(
                    'first_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Employee First Name'
                )
                ->addColumn(
                    'last_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Employee Last Name'
                )
                ->addColumn(
                    'email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Employee Email'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false, 'default' => '1'],
                    'Status'
                )
                ->addForeignKey(
                    $setup->getFkName('perficient_employee',
                        'department_id',
                        'perficient_department',
                        'department_id'),
                    'department_id',
                    $setup->getTable('perficient_department'),
                    'department_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName('perficient_employee',
                        'designation_id',
                        'perficient_designation',
                        'designation_id'),
                    'designation_id',
                    $setup->getTable('perficient_designation'),
                    'designation_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment(
                    'Employee Table For Storing Employee Detail'
                );

            $installer->getConnection()->createTable($table);
        }

        /**
         * Create Trigger for 'Employee Table to manage created_at and updated_at field'
         */
       /* $insertEmployee =
            <<<EOD
            CREATE TRIGGER `employee_insert` 
                BEFORE INSERT ON `perficient_employee` FOR EACH ROW 
                SET NEW.created_at =NOW();
EOD;
        $updateEmployee = <<<EOD
            CREATE TRIGGER `employee_update`
                BEFORE UPDATE ON `perficient_employee` FOR EACH ROW 
                SET NEW.updated_at =NOW();
EOD;
        $installer->run($insertEmployee);
        $installer->run($updateEmployee);
        $installer->endSetup();*/

    }
}