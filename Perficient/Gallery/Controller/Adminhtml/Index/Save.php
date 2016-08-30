<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 4/28/2016
 * Time: 7:09 PM
 */
namespace Perficient\Gallery\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class Save extends Action
{
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();

        $imageIds = isset($data['image_id']) ? $data['image_id'] : array();

        if ($imageIds) {
            unset($data['image_id']);
            $data['image_ids'] = implode(',',$imageIds);
        }
        $categoryIds = isset($data['category_ids']) ? $data['category_ids'] : array();
        if ($categoryIds) {
            unset($data['category_ids']);
            $data['category_ids'] = implode(',',$categoryIds);
        }

        $storeIds = isset($data['store_ids']) ? $data['store_ids'] : array();
        if ($storeIds) {
            unset($data['store_ids']);
            $data['store_ids'] = implode(',',$storeIds);
        }


        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager
                ->create('Perficient\Gallery\Model\Gallery');
            $id = $this->getRequest()->getParam('gallery_id');
            if ($id) {
                $model->load($id);
            }
            $model->setData($data);
            try {
                $model->save();
                $this->messageManager->addSuccess(__('Gallery has been saved'));
                $this->_objectManager
                    ->create('Magento\Backend\Model\Session')
                    ->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit',
                        ['gallery_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager
                    ->addException($e,
                        __('Something went wrong while saving the gallery.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit',
                ['gallery_id' => $this->getRequest()->getParam('gallery_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}

