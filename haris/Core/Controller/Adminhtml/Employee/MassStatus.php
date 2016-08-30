<?php
/**
 * This file will perform mass action for the status enable and desable
 * User: Harishankar.Malviya
 * Date: 5/20/2016
 * Time: 12:11 PM
 */
    namespace Perficient\Core\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Symfony\Component\Config\Definition\Exception\Exception;

class MassStatus extends Action
{
    public function execute()
    {
        // echo "In side function"; exit;
        $ids = $this->getRequest()->getParams();

        if (!is_array($ids) || empty($ids)) {
            $this->messageManager->addError(__('Please select record'));
        } else {

            try {
                foreach ($ids['employee_id'] as $id) {

                    $row = $this->_objectManager
                        ->get('Perficient\Core\Model\Employee')->load($id);
                    $data = ['employee_id' => $id,
                        'status' => $ids['status'] == 1 ? 1 : 0
                    ];
                    $row->setData($data);
                    $row->save();
                }
                $this->messageManager
                    ->addSuccess(__('Total records has been affected::'
                        . count($ids)));
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
        // TODO: Implement execute() method.
    }
}