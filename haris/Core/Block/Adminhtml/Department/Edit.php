<?php
/**
 * This block creats container for the form and here we can add and modify form buttons name
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 4:46 PM
 */
namespace Perficient\Core\Block\Adminhtml\Department;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    )
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);


    }

    public function getHeaderText()
    {
        $departmentRegistry = $this->_coreRegistry->registry('department_data');
        if ($departmentRegistry->getId()) {
            $departmentName = $this->escapeHtml($departmentRegistry->getName());
            return __("Edit Department '%1'", $departmentName);
        } else {
            return __('Add Department');
        }
    }

    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_department';
        $this->_blockGroup = 'Perficient_Core';

        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save'));
        $this->buttonList->update('delete', 'label', __('Delete'));

    }

    /**
     * Prepare layout
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('post_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'post_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', 
                    false, 'post_content');
                }
            };
        ";

        return parent::_prepareLayout();
    }
}