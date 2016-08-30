<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/9/2016
 * Time: 12:35 PM
 */
namespace Perficient\RequestQuote\Model\ResourecModel\Feedback;
class  Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Perficient\RequestQuote\Model\Feedback', 'Perficient\RequestQuote\Model\ResourceModel\Feedback');
    }
}