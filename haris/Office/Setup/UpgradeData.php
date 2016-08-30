<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/20/2016
 * Time: 6:50 PM
 */
namespace Perficient\Office\Setup;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
class UpgradeData implements UpgradeDataInterface
{
    protected $departmentFactory;
    protected $employeeFactory;
    public function __construct(
        \Perficient\Office\Model\DepartmentFactory $departmentFactory,
        \Perficient\Office\Model\EmployeeFactory $employeeFactory
    )
    {
        $this->departmentFactory = $departmentFactory;
        $this->employeeFactory = $employeeFactory;
    }
    public function upgrade(ModuleDataSetupInterface $setup,
                            ModuleContextInterface $context)
    {
       /*$setup->startSetup();
        $salesDepartment = $this->departmentFactory->create();
        $salesDepartment->setName('Sales');
        $salesDepartment->save();
        $employee1 = $this->employeeFactory->create();
        $employee1->setDepartment_id($salesDepartment->getId());
        $employee1->setEmail('goran2@mail.loc');
        $employee1->setFirstName('Goran');
        $employee1->setLastName('Gorvat');
        $employee1->setServiceYears(3);
        $employee1->setDob('1984-04-18');
        $employee1->setSalary(3800.00);
        $employee1->setVatNumber('GB123451234');
        $employee1->setNote('Note #1');
        $employee1->save();
        $setup->endSetup();*/
    }
}