<?php
namespace Perficient\Feedback\Model\ResourceModel\Feedback;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init(
            'Perficient\Feedback\Model\Feedback',
            'Perficient\Feedback\Model\ResourceModel\Feedback'
        );
    }
}