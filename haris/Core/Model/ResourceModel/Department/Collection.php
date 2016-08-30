<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 5:43 PM
 */
namespace Perficient\Core\Model\ResourceModel\Department;

class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Perficient\Core\Model\Department',
            'Perficient\Core\Model\ResourceModel\Department');
    }


}
