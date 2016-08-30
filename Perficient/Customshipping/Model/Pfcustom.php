<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/5/2016
 * Time: 4:29 PM
 */
namespace Perficient\Customshipping\Model;
class Pfcustom extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Perficient\Customshipping\Model\ResourceModel\Pfcustom');
    }
}