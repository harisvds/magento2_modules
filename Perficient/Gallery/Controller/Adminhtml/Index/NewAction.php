<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 4/28/2016
 * Time: 4:05 PM
 */

namespace Perficient\Gallery\Controller\Adminhtml\Index;

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