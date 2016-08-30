<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/9/2016
 * Time: 12:33 PM
 */
namespace Perficient\RequestQuote\Model;
class Quote extends \Magento\Framework\Model\AbstractModel{
    protected function _construct()
    {
       $this->_init('Perficient\RequestQuote\Model\ResourceModel\Quote');
    }
}