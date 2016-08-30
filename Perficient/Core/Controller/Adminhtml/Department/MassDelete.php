<?php
/**
 * This file will perform mass delete action for the department
 * User: Harishankar.Malviya
 * Date: 5/20/2016
 * Time: 12:05 PM
 */
namespace Perficient\Core\Controller\Adminhtml\Department;

use Magento\Backend\App\Action;
use Symfony\Component\Config\Definition\Exception\Exception;

class MassDelete extends Action
{
    public function execute()
    {
        $ids = $this->getRequest()->getParams()['department_id'];

        if (!is_array($ids) || empty($ids)) {
            $this->messageManager->addError(__('Please select records'));
        } else {

            try {
                foreach ($ids as $id) {

                    $row = $this->_objectManager
                        ->get('Perficient\Core\Model\Department')->load($id);
                    $row->delete();
                }
                $this->messageManager
                    ->addSuccess(__('Total records has been deleted::'
                        . count($ids)));
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
        // TODO: Implement execute() method.
    }
}