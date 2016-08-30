<?php
namespace Perficient\Gallery\Block\Adminhtml;

class Gallery extends \Magento\Backend\Block\Widget\Grid\Container
{

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {

        $this->_blockGroup = "Perficient_Gallery";
        $this->_controller = "adminhtml_gallery";
        parent::__construct($context, $data);
    }

}