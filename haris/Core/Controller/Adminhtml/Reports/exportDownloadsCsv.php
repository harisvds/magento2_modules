<?php
namespace Perficient\Core\Controller\Adminhtml\Reports;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class ExportDownloadsCsv extends \Magento\Backend\App\Action
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
     * Export products downloads report to CSV format
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $fileName = 'employee_downloads.csv';
        $content = $this->_view->getLayout()->createBlock(
            'Perficient\Core\Block\Adminhtml\Reports\Grid'
        )->setSaveParametersInSession(
            true
        )->getCsv();

        return $this->_fileFactory->create($fileName, $content);

    }
}
