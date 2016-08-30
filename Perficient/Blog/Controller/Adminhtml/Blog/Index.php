<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

namespace Perficient\Blog\Controller\Adminhtml\Blog;
use \Perficient\Blog\Controller\Adminhtml\Blog;
class Index extends Blog
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        //echo "In side function";exit();
//        if ($this->getRequest()->getQuery('ajax')) {
//            $this->_forward('grid');
//            return;
//        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Perficient_Blog::blog');
        $resultPage->getConfig()->getTitle()->prepend(__('Blogs'));
        $resultPage->addBreadcrumb(__('Blog'), __('Blog'));
        return $resultPage;
    }
    public function newAction(){
      
    }
}
