<?php
/**
 * This block add tab and its contents in the admin section
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 4:49 PM
 */
namespace Perficient\Core\Block\Adminhtml\Designation\Edit;

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
        $this->setId('designation_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Designation Information'));
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'department_info',
            [
                'label' => __('Designation'),
                'title' => __('Designation'),
                'content' => $this->getLayout()->createBlock(
                    'Perficient\Core\Block\Adminhtml\Designation\Edit\Tab\FormInfo'
                )->toHtml(),
                'active' => true
            ]
        );
        return parent::_beforeToHtml();
    }
}
