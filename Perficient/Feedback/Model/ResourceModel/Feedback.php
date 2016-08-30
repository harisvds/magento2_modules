<?php
namespace Perficient\Feedback\Model\ResourceModel;
class Feedback extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('perficient_feedback', 'id');
    }
}