<?php
namespace Perficient\Elogger\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Perficient\Elogger\Model\EmailLogger;

class Detail extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $jsonResultFactory;

    /**
     * @var modelFactory
     */
    protected $modelFactory;


    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param EmailLogger $emailLogger
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        Json $resultJsonFactory,
        EmailLogger $emailLogger

    )
    {
        parent::__construct($context);
        $this->jsonResultFactory = $resultJsonFactory;
        $this->modelFactory = $emailLogger;

    }

    /**
     * Index action
     * @return void
     */
    public function execute()
    {
        $emailId = $this->getRequest()->getParam('email_id');
        $collection = $this->modelFactory->load($emailId);

        /** @var \Magento\Framework\Controller\Result\Json $result */

        $result = $this->jsonResultFactory;
        $result->setData(['data' => $collection->getData()]);
        return $result;
    }
}
