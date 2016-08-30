<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/2/2016
 * Time: 5:49 PM
 */
namespace Perficient\Gallery\Controller\Adminhtml\Images;

use Magento\Backend\App\Action;

class Edit extends Action
{
    protected $_resultCoreRegistory;
    protected $_resultPageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    )
    {
        $this->_resultCoreRegistory = $registry;
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        error_reporting(E_ALL);
        ini_set('display_errors',1);
        $id = $this->getRequest()->getParam('image_id');
        $model = $this->_objectManager
            ->create('Perficient\Gallery\Model\Images');
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager
                    ->addError(__('This image is no longer exist'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('/*/*');
            }
        }
        $data = $this->_objectManager
            ->get('Magento\Backend\Model\Session')->getFormDadta(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_resultCoreRegistory->register('image_data', $model);
        $resultPage = $this->_initAction();
        $resultPage->addBreadCrumb(
            $id ? __('Edit Image') : __('New Image'),
            $id ? __('Edit Image') : __('New Image')
        );
        $resultPage->getConfig()->getTitle()->prepend('Image');
        $resultPage->getConfig()->getTitle()->prepend(
            $id ? __('Images') : __('New Images')
        );
        return $resultPage;
    }

    protected function _initAction()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Perficient_Gallery::images');
        $resultPage->addBreadcrumb(__('Manage Image'), __('Manage Image'));
        $resultPage->addBreadcrumb(__('Manage Image'), __('Manage Image'));
        return $resultPage;

    }


}