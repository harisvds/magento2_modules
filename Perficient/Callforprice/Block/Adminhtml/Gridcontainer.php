<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/1/2016
 * Time: 7:26 PM
 */

namespace Perficient\Callforprice\Block\Adminhtml;
class Gridcontainer extends \Magento\Backend\Block\Widget\Grid\Container
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
        $this->_blockGroup = "Perficient_Callforprice";
        $this->_controller = "adminhtml_index";
        parent::__construct($context, $data);
        $this->removeButton('add');

    }

}