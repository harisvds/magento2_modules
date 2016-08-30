<?php
namespace Perficient\Elogger\Controller\Adminhtml\Index;

use \Magento\Backend\App\Action\Context;
use \Magento\Framework\Registry;
use \Magento\Framework\View\Result\PageFactory;
use Perficient\Elogger\Model\EmailLogger;

class View extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var modelFactory
     */
    protected $modelFactory;

    /**
     * @var $registryFactory
     */
    protected $registryFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param EmailLogger $emailLogger
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        EmailLogger $emailLogger,
        Registry $registry

    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->modelFactory = $emailLogger;
        $this->registryFactory = $registry;
    }

    /**
     * Index action
     * @return void
     */
    public function execute()
    {
        $emailId = $this->getRequest()->getParam('id');
        $collection = $this->modelFactory->load($emailId);
        $this->registryFactory->register('emailLoagData', $collection->getData());

        /**
         * @var \Magento\Backend\Model\View\Result\Page $resultPage
         */
        $pageFactory = $this->resultPageFactory->create();
        return $pageFactory;
    }
}
