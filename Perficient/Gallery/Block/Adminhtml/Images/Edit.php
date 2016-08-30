<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/2/2016
 * Time: 6:58 PM
 */
namespace Perficient\Gallery\Block\Adminhtml\Images;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;

class Edit extends Container
{


    protected $_coreRegistry = null;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        array $data)
    {

        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    public function getHeaderText()
    {
        $imageRegistry = $this->_coreRegistry->regitry('image_data');
        if ($imageRegistry->geId()) {
            $imageFormTitle = $this->escapeHtml($imageRegistry->getTitle());
            return __("Edit Gallery '%1'", $imageFormTitle);
        } else {
            return __('Add Gallery');
        }
    }

    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_images';
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

}