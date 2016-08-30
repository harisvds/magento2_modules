<?php
namespace Perficient\Gallery\Block\Adminhtml;

class Images extends \Magento\Backend\Block\Widget\Grid\Container
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
        //echo "In side function"; exit;
        $this->_blockGroup = "Perficient_Gallery";
        $this->_controller = "adminhtml_images";
        parent::__construct($context, $data);
    }

}