<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/6/2016
 * Time: 11:40 AM
 */
namespace Perficient\Gallery\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{

    protected $_resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $page = $this->_resultPageFactory->create();
        return $page;
    }
}