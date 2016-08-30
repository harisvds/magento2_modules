<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 2/26/2016
 * Time: 1:05 PM
 */
namespace Perficient\Elogger\Model\ResourceModel\EmailLogger;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Perficient\Elogger\Model\EmailLogger',
            'Perficient\Elogger\Model\ResourceModel\EmailLogger'
        );
    }
}