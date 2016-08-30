<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 4/28/2016
 * Time: 3:51 PM
 */
namespace Perficient\Gallery\Block\Adminhtml\Gallery\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

class Tabs extends WidgetTabs
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('gallery_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Gallery Information'));
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'gallery_info',
            [
                'label' => __('Gallery'),
                'title' => __('Gallery'),
                'content' => $this->getLayout()->createBlock(
                    'Perficient\Gallery\Block\Adminhtml\Gallery\Edit\Tab\Info'
                )->toHtml(),
                'active' => true
            ]
        );
        $this->addTab(
            'image_info',
            [
                'label' => __('Gallery Images'),
                'title' => __('Images'),
                'content' => $this->getLayout()->createBlock(
                    'Perficient\Gallery\Block\Adminhtml\Images\Gridwithoutmask'
                )->toHtml(),
                'active' => false
            ]
        );
       
        return parent::_beforeToHtml();
    }
}
