<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/19/2016
 * Time: 2:25 PM
 */
namespace Perficient\Office\Model;
class Department extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Perficient\Office\Model\ResourceModel\Department');
    }
}