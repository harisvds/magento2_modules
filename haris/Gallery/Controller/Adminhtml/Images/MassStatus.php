<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/5/2016
 * Time: 5:11 PM
 */
namespace Perficient\Gallery\Controller\Adminhtml\Images;

use Magento\Backend\App\Action;
use Symfony\Component\Config\Definition\Exception\Exception;

class MassStatus extends Action
{
    public function execute()
    {
        $ids = $this->getRequest()->getParams();

        if (!is_array($ids) || empty($ids)) {
            $this->messageManager->addError(__('Please select gallery'));
        } else {

            try {
                foreach ($ids['image_id'] as $id) {

                    $row = $this->_objectManager
                        ->get('Perficient\Gallery\Model\Images')->load($id);
                    if ($ids['status'] == '1') {

                    }
                    $data = ['image_id' => $id,
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