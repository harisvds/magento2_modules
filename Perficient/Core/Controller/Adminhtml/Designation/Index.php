<?php
/**
 * This page  will create layout for the designation index page.
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 4:36 PM
 */
namespace Perficient\Core\Controller\Adminhtml\Designation;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    protected $_coreResistory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory

    )
    {
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
        $resultPage->setActiveMenu('Perficient_Core::designation');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb
        (
            __('Manage Designation'),
            __('Manage Designation')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Designation'));
        return $resultPage;
    }
}
