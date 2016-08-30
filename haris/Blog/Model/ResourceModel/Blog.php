<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 2/26/2016
 * Time: 1:03 PM
 */
namespace Perficient\Blog\Model\ResourceModel;

class Blog extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('perficient_blog', 'blog_id');

    }
}