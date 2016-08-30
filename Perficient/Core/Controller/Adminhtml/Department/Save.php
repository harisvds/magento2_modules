<?php
/**
 * This file saves the information while add/edit operation performed
 * User: Harishankar.Malviya
 * Date: 5/20/2016
 * Time: 10:45 AM
 */
namespace Perficient\Core\Controller\Adminhtml\Department;

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
                ->create('Perficient\Core\Model\Department');
            $id = $this->getRequest()->getParam('department_id');
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
                            'department_id' => $model->getId(),
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
                ['department_id' => $this->getRequest()
                    ->getParam('department_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}

