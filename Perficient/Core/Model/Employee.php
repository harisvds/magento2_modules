<?php
/**
 * Model for the Employee
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 5:34 PM
 */

namespace Perficient\Core\Model;

class Employee extends \Magento\Framework\Model\AbstractModel
{
 
    public function _construct()
    {
        $this->_init('Perficient\Core\Model\ResourceModel\Employee');
    }
}