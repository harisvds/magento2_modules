<?php
/**
 * This page  will return the object of layout for the employee  page which will build the layout based on layout xml file.
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 4:36 PM
 */
namespace Perficient\Core\Controller\Adminhtml\Employee;

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

        //echo "IN side function"; exit;
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Perficient_Core::employee');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb
        (
            __('Manage Designation'),
            __('Manage Designation')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Employee'));
        return $resultPage;
    }
}
