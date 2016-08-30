<?php
/**
 *  This block creates a grid container for designation
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 4:12 PM
 */
namespace Perficient\Core\Block\Adminhtml;

class Designation extends \Magento\Backend\Block\Widget\Grid\Container
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
        $this->_blockGroup = "Perficient_Core";
        $this->_controller = "adminhtml_designation";
        parent::__construct($context, $data);

    }

}