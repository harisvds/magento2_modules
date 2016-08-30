<?php
/**
 * This controller will map url for the employee reports
 * User: Harishankar.Malviya
 * Date: 5/31/2016
 * Time: 3:27 PM
 */
namespace Perficient\Core\Controller\Adminhtml\Reports;

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
        $resultPage->setActiveMenu('Perficient_Core::reports');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb
        (
            __('Reports'),
            __('Reports')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Reports'));
        return $resultPage;
    }
}
