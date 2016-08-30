<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/20/2016
 * Time: 3:15 PM
 */
namespace Perficient\Office\Model\ResourceModel;
class Employee extends \Magento\Eav\Model\Entity\AbstractEntity
{
    protected function _construct()
    {
        $this->_read = 'perficient_office_employee_read';
        $this->_write = 'perficient_office_employee_write';
    }
    public function getEntityType()
    {
        if (empty($this->_type)) {
            $this->setType(\Perficient\Office\Model\Employee::ENTITY);
        }
        return parent::getEntityType();
    }
}