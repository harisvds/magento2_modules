<?php
/**
 * Copyright © 2015 Pagseguro. All rights reserved.
 */

namespace Perficient\Blog\Controller\Adminhtml\Blog;
use \Perficient\Blog\Controller\Adminhtml\Blog;

class Save extends Blog
{
    public function execute()
    {

        if ($this->getRequest()->getPostValue()) {
            try {

                $model = $this->_objectManager->create('Perficient\Blog\Model\Blog');


                $data = $this->getRequest()->getPostValue();
                $inputFilter = new \Zend_Filter_Input(
                    [],
                    [],
                    $data
                );

                $data = $inputFilter->getUnescaped();
                $id = $this->getRequest()->getParam('id');


                if ($id) {
                    $model->load($id);
                    if ($id != $model->getId()) {
                        throw new \Magento\Framework\Exception\LocalizedException(__('The wrong item is specified.'));
                    }
                }
               // print_r($model->getData());
                $model->setData($data);

                $session = $this->_objectManager->get('Magento\Backend\Model\Session');

                $session->setPageData($model->getData());
                $model->save();
                $this->messageManager->addSuccess(__('You saved the item.'));
                $session->setPageData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('blogs/*/edit', ['id' => $model->getId()]);
                    return;
                }
                $this->_redirect('blogs/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
                $id = (int)$this->getRequest()->getParam('id');
                if (!empty($id)) {
                    $this->_redirect('blogs/*/edit', ['id' => $id]);
                } else {
                    $this->_redirect('blogs/*/new');
                }
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('Something went wrong while saving the item data. Please review the error log.')
                );
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($data);
                $this->_redirect('blogs/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->_redirect('blogs/*/');
    }
}
