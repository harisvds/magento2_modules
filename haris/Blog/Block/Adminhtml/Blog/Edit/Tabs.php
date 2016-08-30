<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */
namespace Perficient\Blog\Block\Adminhtml\Blog\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
       // echo "In side tab"; exit;
        parent::_construct();
        $this->setId('perficient_blog_blog_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Blog'));
    }
}
