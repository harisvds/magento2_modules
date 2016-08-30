<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 2/29/2016
 * Time: 11:38 AM
 */
namespace Perficient\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Perficient\Blog\Helper\Data;
use Perficient\Blog\Model\BlogFactory;

class Index extends Action
{

    protected $_modelBlogFactory;
    protected $_pageFactory;
    protected $_dataHelper;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Data $dataHelper,
        BlogFactory $blogFactory
    )
    {

        $this->_modelBlogFactory = $blogFactory;
        $this->_pageFactory = $pageFactory;
        $this->_dataHelper = $dataHelper;
        parent::__construct($context);
    }

    public function execute()
    {
       $pageFactory=$this->_pageFactory->create();
        return $pageFactory;


    }
}
