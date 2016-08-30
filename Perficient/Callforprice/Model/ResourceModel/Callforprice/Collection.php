<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/29/2016
 * Time: 11:54 AM
 */
namespace Perficient\Callforprice\Model\ResourceModel\Callforprice;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Perficient\Callforprice\Model\Callforprice',
            'Perficient\Callforprice\Model\ResourceModel\Callforprice'
        );
    }
}