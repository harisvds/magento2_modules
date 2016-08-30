<?php

namespace Perficient\Gallery\Block\Adminhtml\Gallery;

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

    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_gallery';
        $this->_blockGroup = 'Perficient_Gallery';

        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save'));

        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'    
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete'));

    }
     public function getHeaderText()
    {
        $galleryRegistry = $this->_coreRegistry->registry('gallery_data');
        if ($galleryRegistry->getId()) {
            $galleryTitle = $this->escapeHtml($galleryRegistry->getTitle());
            return __("Edit Gallery '%1'", $galleryTitle);
        } else {
            return __('Add Gallery');
        }
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