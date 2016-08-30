<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/20/2016
 * Time: 3:12 PM
 */
namespace Perficient\Office\Model;
class Employee extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = 'perficient_office_employee';

    public function _construct()
    {
        $this->_init('Perficient\Office\Model\ResourceModel\Employee');
    }
}