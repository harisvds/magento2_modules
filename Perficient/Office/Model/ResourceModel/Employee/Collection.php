<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/20/2016
 * Time: 3:22 PM
 */
namespace Perficient\Office\Model\ResourceModel\Employee;
class Collection extends
    \Magento\Eav\Model\Entity\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Perficient\Office\Model\Employee',
            'Perficient\Office\Model\ResourceModel\Employee');
    }
}