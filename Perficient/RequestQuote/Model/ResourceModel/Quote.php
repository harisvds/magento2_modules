<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/9/2016
 * Time: 12:34 PM
 */
namespace Perficient\RequestQuote\Model\ResourceModel;
class Quote extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('perficient_quote', 'id');
    }
}