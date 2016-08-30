<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/20/2016
 * Time: 6:25 PM
 */
namespace Perficient\Office\Setup;
use Magento\Eav\Setup\EavSetup;
class EmployeeSetup extends EavSetup
{
    public function getDefaultEntities()
    {
       // echo "In side file"; exit;
        $employeeEntity = \Perficient\Office\Model\Employee::ENTITY;
        $entities = [
            $employeeEntity => [
                'entity_model' => 'Perficient\Office\Model\ResourceModel\Employee',
                'table' => $employeeEntity . '_entity',
                'attributes' => [
                    'department_id' => [
                        'type' => 'static',
                    ],
                    'email' => [
                        'type' => 'static',
                    ],
                    'first_name' => [
                        'type' => 'static',
                    ],
                    'last_name' => [
                        'type' => 'static',
                    ],
                ],
            ],
        ];
        return $entities;
    }
}