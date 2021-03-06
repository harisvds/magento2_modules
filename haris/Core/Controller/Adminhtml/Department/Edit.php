<?php
/**
 * This file is used for add/edit  department
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 6:38 PM
 */
namespace Perficient\Core\Controller\Adminhtml\Department;

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
        $id = $this->getRequest()->getParam('department_id');
        $model = $this->_objectManager
            ->create('Perficient\Core\Model\Department');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager
                    ->addError(__('This department no longer exists.'));
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
        $this->_coreRegistry->register('department_post', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Gallery') : __('New Department'),
            $id ? __('Edit Gallery') : __('New Department')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Department'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Department'));

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
        $resultPage->setActiveMenu('Perficient_Core::department')
            ->addBreadcrumb(__('Manage Department'), __('Manage Department'))
            ->addBreadcrumb(__('Manage Department'), __('Manage Department'));
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
