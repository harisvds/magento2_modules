<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 4/29/2016
 * Time: 11:08 AM
 */
namespace Perficient\Gallery\Model\ResourceModel;
class Images extends
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('perficient_gallery_images', 'image_id');
    }

}
