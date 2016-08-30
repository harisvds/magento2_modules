<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 6/7/2016
 * Time: 12:22 PM
 */
namespace Perficient\Elogger\Model;
class EmailLogger extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
       // echo "In side model"; exit;
        $this->_init('Perficient\Elogger\Model\ResourceModel\EmailLogger');
    }
}