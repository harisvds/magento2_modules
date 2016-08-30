<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Perficient\Core\Controller\Adminhtml\Reports;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class ExportEmployeesExcel extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $_fileFactory;
    protected $_pageFactroy;

    /**
     * @param Context $context
     * @param FileFactory $fileFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        FileFactory $fileFactory
    )
    {
        parent::__construct($context);
        $this->_pageFactroy = $pageFactory;
        $this->_fileFactory = $fileFactory;
    }

    /**
     * Export customers most ordered report to Excel XML format
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $fileName = 'employees.xml';
        $grid = $this->_view->getLayout()
            ->createBlock('Perficient\Core\Block\Adminhtml\Reports\Grid');
        return $this->_fileFactory
            ->create(
                $fileName,
                $grid->getExcelFile($fileName),
                DirectoryList::VAR_DIR
            );

    }
}
