<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/9/2016
 * Time: 11:34 AM
 */

namespace Perficient\RequestQuote\Controller\Index;
class  Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {

        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        //echo "In side function"; exit;
        $pageResult = $this->_pageFactory->create();
        $pageResult->getConfig()->getTitle()->set(__('Request Quote'));
        
        return $pageResult;

        // TODO: Implement execute() method.

    }
}