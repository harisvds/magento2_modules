<?php
namespace Perficient\Gallery\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    protected $_coreResistory;
    protected $_eventManager;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ManagerInterface $eventManager

    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_eventManager = $eventManager;

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
        /*      $model = $this->_objectManager
                  ->create('Perficient\Gallery\Model\Gallery');
              echo "<pre>";
              print_r($model->load(1));*/

        $resultPage->setActiveMenu('Perficient_Gallery::gallery');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb(__('Manage Gallery'), __('Manage Gallery'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Gallery'));
        $this->_eventManager->dispatch('gallery_index_visit',[
            'controllerx'=>'Hari'
        ]);
        return $resultPage;
    }
}
