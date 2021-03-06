<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 3:10 PM
 */
namespace Perficient\Core\Model\ResourceModel;

class Employee extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('perficient_employee', 'employee_id');
    }
}
