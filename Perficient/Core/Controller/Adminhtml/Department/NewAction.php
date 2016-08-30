<?php
/**
 * This file will redirect on edit controller while new action performed
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 6:37 PM
 */
namespace Perficient\Core\Controller\Adminhtml\Department;

class NewAction extends \Magento\Backend\App\Action
{
    protected $_resultFarwardFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $forwardFactory)
    {
        $this->_resultFarwardFactory=$forwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {

        $result=$this->_resultFarwardFactory->create();
        return  $result->forward('edit');
    }
    protected function _isAllowed()
    {
        return true;
    }
}