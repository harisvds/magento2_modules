<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/29/2016
 * Time: 11:44 AM
 */
namespace Perficient\Callforprice\Model;
class Callforprice extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Perficient\Callforprice\Model\ResourceModel\Callforprice');
    }
}