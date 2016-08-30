<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/31/2016
 * Time: 4:52 PM
 */
namespace Perficient\Core\Block\Adminhtml;
class Reports extends \Magento\Backend\Block\Widget\Grid\Container
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
        $this->_controller = "adminhtml_reports";
        parent::__construct($context, $data);
        $this->buttonList->remove('add');
      /*  $this->addButton(
            'filter_form_submit',
            ['label' => __('Show Report'), 'onclick' => 'filterFormSubmit()', 'class' => 'primary']
        );*/
    }
    /**
     * Get filter URL
     *
     * @return string
     */
    public function getFilterUrl()
    {
        $this->getRequest()->setParam('filter', null);
        return $this->getUrl('*/*/report', ['_current' => true]);
    }
}