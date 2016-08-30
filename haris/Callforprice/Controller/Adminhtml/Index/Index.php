<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/1/2016
 * Time: 6:57 PM
 */
namespace Perficient\Callforprice\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{

    protected $_resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    )
    {
        parent::__construct($context);
        $this->_resultPageFactory = $pageFactory;
    }

    public function execute()
    {

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Perficient_Callforprice::callforprice');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb
        (
            __('Call For Free'),
            __('Call For Free')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Call For Free Customer Detial'));
        return $resultPage;
    }
}