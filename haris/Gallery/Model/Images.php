<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 4/29/2016
 * Time: 10:55 AM
 */
namespace Perficient\Gallery\Model;

class Images extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Perficient\Gallery\Model\ResourceModel\Images');
    }
}

