<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/4/2016
 * Time: 6:17 PM
 */
namespace Perficient\Gallery\Block\Adminhtml\Images\Grid\Renderer;

use \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use \Magento\Store\Model\StoreManagerInterface;

class Image extends AbstractRenderer
{
    private $_storeManager;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        StoreManagerInterface $storeManager,
        array $data = [])
    {
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
        $this->_authorization = $context->getAuthorization();
    }

    public function render(\Magento\Framework\DataObject $row)
    {
        $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(
            \Magento\Framework\App\Filesystem\DirectoryList::MEDIA
        );
        $imageUrl =
            $mediaDirectory . $this->_getValue($row);
        return '<img src="' . $imageUrl . '" width="200"/>';
    }
}
