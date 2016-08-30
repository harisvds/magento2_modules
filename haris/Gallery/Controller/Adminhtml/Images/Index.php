<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 4/29/2016
 * Time: 10:43 AM
 */
namespace Perficient\Gallery\Controller\Adminhtml\Images;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{

    protected $_resultPageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {

        $this->_resultPageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
      /*  $model = $this->_objectManager
            ->create('Perficient\Gallery\Model\Images');
         echo "<pre>";
        $data=$model->load(1);
        print_r($data->getData());
        exit;*/
        $page = $this->_resultPageFactory->create();
        $page->setActiveMenu('Perficient_Gallery::gallery/images');
        $page->addBreadCrumb(__('Cms'), __('Cms'));
        $page->addBreadcrumb(__('Manage Gallery'), __('Manage Gallery'));
        $page->getConfig()->getTitle()->prepend(__('Manage Gallery'));

        return $page;


    }
}