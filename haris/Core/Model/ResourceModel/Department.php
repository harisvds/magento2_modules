<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 5:40 PM
 */
namespace Perficient\Core\Model\ResourceModel;

class Department extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('perficient_department', 'department_id');
    }
}
