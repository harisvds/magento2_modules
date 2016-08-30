<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/20/2016
 * Time: 5:30 PM
 */
namespace Perficient\Office\Setup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
class InstallData implements InstallDataInterface
{
    private $employeeSetupFactory;
    public function __construct(
        \Perficient\Office\Setup\EmployeeSetupFactory $employeeSetupFactory
    )
    {
        $this->employeeSetupFactory = $employeeSetupFactory;
    }
    public function install(ModuleDataSetupInterface $setup,
                            ModuleContextInterface $context)
    {
        $setup->startSetup();
        /* #snippet1 */
        $employeeEntity = \Perficient\Office\Model\Employee::ENTITY;
        $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
        $employeeSetup->installEntities();
        $employeeSetup->addAttribute(
            $employeeEntity, 'service_years', ['type' => 'int']
        );
        $employeeSetup->addAttribute(
            $employeeEntity, 'dob', ['type' => 'datetime']
        );
        $employeeSetup->addAttribute(
            $employeeEntity, 'salary', ['type' => 'decimal']
        );
        $employeeSetup->addAttribute(
            $employeeEntity, 'vat_number', ['type' => 'varchar']
        );
        $employeeSetup->addAttribute(
            $employeeEntity, 'note', ['type' => 'text']
        );
        $setup->endSetup();
    }
}