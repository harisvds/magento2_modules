<?php
/**
 * This file is used for add/edit  designation
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 6:38 PM
 */
namespace Perficient\Core\Controller\Adminhtml\Designation;

use Magento\Backend\App\Action;

class Edit extends Action
{

    protected $_coreRegistry = null;

    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    public function execute()
    {

        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('designation_id');
        $model = $this->_objectManager
            ->create('Perficient\Core\Model\Designation');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager
                    ->addError(__('This designation no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        // 3. Set entered data if was error when we do save
        $data = $this->_objectManager
            ->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        // 4. Register model to use later in blocks
        $this->_coreRegistry->register('designation_post', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Designation') : __('New Designation'),
            $id ? __('Edit Designation') : __('New Designation')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Designation'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Designation'));

        return $resultPage;
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Perficient_Core::designation')
            ->addBreadcrumb(__('Manage Designation'), __('Manage Designation'))
            ->addBreadcrumb(__('Manage Designation'), __('Manage Designation'));
        return $resultPage;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return true;
    }
}
