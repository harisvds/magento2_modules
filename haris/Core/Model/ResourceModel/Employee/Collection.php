<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 3:11 PM
 */

namespace Perficient\Core\Model\ResourceModel\Employee;

class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Perficient\Core\Model\Employee',
            'Perficient\Core\Model\ResourceModel\Employee');
    }

}
