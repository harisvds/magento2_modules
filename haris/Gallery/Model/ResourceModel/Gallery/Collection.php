<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Perficient\Gallery\Model\ResourceModel\Gallery;

class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Perficient\Gallery\Model\Gallery',
            'Perficient\Gallery\Model\ResourceModel\Gallery');
        //$this->_map['fields']['page_id'] = 'main_table.page_id';
    }


}
