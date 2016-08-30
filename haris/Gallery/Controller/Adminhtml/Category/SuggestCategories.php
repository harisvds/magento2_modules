<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Perficient\Gallery\Controller\Adminhtml\Category;

class SuggestCategories extends \Magento\Catalog\Controller\Adminhtml\Category\SuggestCategories
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \Magento\Framework\View\LayoutFactory
     */
    protected $layoutFactory;



    /**
     * Category list suggestion based on already entered symbols
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
       // echo "In side funciton"; exit;
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setJsonData(
            $this->layoutFactory->create()->createBlock('Perficient\Gallery\Block\Adminhtml\Category\Tree')
                ->getSuggestedCategoriesJsonX($this->getRequest()->getParam('label_part'))
        );
    }
}
