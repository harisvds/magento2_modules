<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/19/2016
 * Time: 7:52 PM
 */
namespace Perficient\Office\Model\ResourceModel;
class Department extends
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('perficient_office_department', 'entity_id');
    }
}

    