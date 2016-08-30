<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 6/7/2016
 * Time: 6:09 PM
 */
namespace Perficient\Elogger\Block\Adminhtml\Elogger\Grid\Renderer;

use Magento\Store\Model\StoreManagerInterface;
class Description extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    public function __construct(
        \Magento\Backend\Block\Context $context,
        array $data = [])
    {
        parent::__construct($context, $data);
        $this->_authorization = $context->getAuthorization();
    }

    public function render(\Magento\Framework\DataObject $row)
    {
        //return strlen($this->_getValue($row)) > 200 ? substr($this->_getValue($row), 0, 200) : $this->_getValue($row);

        return "<a class='viewHistory' href='javascript:void(0);' data-attr='".$this->_getValue($row)."'>View</a>";

    }

}