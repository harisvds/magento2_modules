<?php
/**
 * This file will return page result for the the departments.
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 4:36 PM
 */
namespace Perficient\Core\Controller\Adminhtml\Department;

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
        $resultPage->setActiveMenu('Perficient_Core::department');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb
        (
            __('Manage Department'),
            __('Manage Department')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Department'));
        return $resultPage;
    }
}
