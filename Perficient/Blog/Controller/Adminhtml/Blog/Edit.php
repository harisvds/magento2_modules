<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

namespace Perficient\Blog\Controller\Adminhtml\Blog;
use \Perficient\Blog\Controller\Adminhtml\Blog;
class Edit extends Blog
{

    public function execute()
    {

        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Perficient\Blog\Model\Blog');

        if ($id) {
            $model->load($id);

            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('blogs/*');
                return;
            }
        }

        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);

        if (!empty($data)) {
            $model->addData($data);
        }

        $this->_coreRegistry->register('current_perficient_blog_blog', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('blog_blog_edit');
        $this->_view->renderLayout();

    }

}
