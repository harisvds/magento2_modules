<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 5/3/2016
 * Time: 12:31 PM
 */
namespace Perficient\Gallery\Block\Adminhtml\Images\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

class Tabs extends WidgetTabs
{

    protected function _construct()
    {
        $this->setId('image_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Imagages Information'));
        parent::_construct(); // TODO: Change the autogenerated stub
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'image_info',
            [
                'label' => __('Gallery Images'),
                'title' => __('Gallery Images'),
                'content' => $this->getLayout()->CreateBlock(
                        'Perficient\Gallery\Block\Adminhtml\Images\Edit\Tab\ImageInfo'
                    )->toHtml(),
                'active' => false
            ]
        );
        return parent::_beforeToHtml(); // TODO: Change the autogenerated stub
    }

}