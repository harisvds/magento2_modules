<?php
/**
 * This file will redirect on edit controller while new action performed
 * User: Harishankar.Malviya
 * Date: 5/20/2016
 * Time: 10:45 AM
 */
namespace Perficient\Core\Controller\Adminhtml\Designation;

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
      
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager
                ->create('Perficient\Core\Model\Designation');
            $id = $this->getRequest()->getParam('designation_id');
            if ($id) {
                $model->load($id);
            }
            $model->setData($data);
            try {
                $model->save();
                $this->messageManager->addSuccess(__('Record has been saved'));
                $this->_objectManager
                    ->create('Magento\Backend\Model\Session')
                    ->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit',
                        [
                            'designation_id' => $model->getId(),
                            '_current' => true
                        ]
                    );
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager
                    ->addException($e,
                        __('Something went wrong while saving the record.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit',
                ['designation_id' => $this->getRequest()
                    ->getParam('designation_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}

