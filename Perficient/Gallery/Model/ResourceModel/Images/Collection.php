<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 4/29/2016
 * Time: 11:51 AM
 */
namespace Perficient\Gallery\Model\ResourceModel\Images;

class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected function _construct()
    {
        $this->_init('Perficient\Gallery\Model\Images',
            'Perficient\Gallery\Model\ResourceModel\Images');
        //$this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}