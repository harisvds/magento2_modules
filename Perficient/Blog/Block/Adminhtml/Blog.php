<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 2/26/2016
 * Time: 1:11 PM
 */

namespace Perficient\Blog\Block\Adminhtml;

class Blog extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Perficient_Blog';
        $this->_controller = 'adminhtml_blog';
        $this->_headerText = __('Blogs');
        $this->_addButtonLabel = __('Add New Blog');
        parent::_construct();
//        $this->buttonList->add(
//            'blog_apply',
//            [
//                'label' => __('Blog'),
//                'onclick' => "location.href='" . $this->getUrl('blog/*/applyAffiliate') . "'",
//                'class' => 'apply'
//            ]
//        );
    }
}