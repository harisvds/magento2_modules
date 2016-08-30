<?php
namespace Perficient\Feedback\Model;

class  Feedback extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Perficient\Feedback\Model\ResourceModel\Feedback');
    }
}