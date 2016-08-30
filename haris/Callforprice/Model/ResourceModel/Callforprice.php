<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/29/2016
 * Time: 11:49 AM
 */
namespace Perficient\Callforprice\Model\ResourceModel;

class Callforprice extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('perficient_call_for_price', 'id');
    }
}