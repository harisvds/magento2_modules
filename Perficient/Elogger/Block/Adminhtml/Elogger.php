<?php
/**
 *  This block creates a grid container for Department
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 4:12 PM
 */
namespace Perficient\Elogger\Block\Adminhtml;

class Elogger extends \Magento\Backend\Block\Widget\Grid\Container
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
        //echo "In side blog"; exit;
        $this->_blockGroup = "Perficient_Core";
        $this->_controller = "adminhtml_index";
        parent::__construct($context, $data);
        $this->removeButton('add');
     
    }

}