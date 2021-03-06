<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/5/2016
 * Time: 5:11 PM
 */
namespace Perficient\Gallery\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Symfony\Component\Config\Definition\Exception\Exception;

class MassDelete extends Action
{
    public function execute()
    {
        $ids = $this->getRequest()->getParams()['gallery_id'];

        if (!is_array($ids) || empty($ids)) {
            $this->messageManager->addError(__('Please select gallery'));
        } else {

            try {
                foreach ($ids as $id) {

                    $row = $this->_objectManager
                        ->get('Perficient\Gallery\Model\Gallery')->load($id);
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