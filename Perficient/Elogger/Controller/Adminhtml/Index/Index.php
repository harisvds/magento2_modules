<?php
namespace Perficient\Elogger\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;



class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory

    )
    {
        // echo "IN side construct";exit;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;

    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute()
    {

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Perficient_Ellogger::emaillog');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb
        (
            __('Email History'),
            __('Email History')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Email History'));
        return $resultPage;
    }
}
