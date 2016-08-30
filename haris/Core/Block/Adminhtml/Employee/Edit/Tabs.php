<?php
/**
 * This block add tab in the admin section
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 4:49 PM
 */
namespace Perficient\Core\Block\Adminhtml\Employee\Edit;

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
        $this->setId('employee_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Employee Information'));
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'department_info',
            [
                'label' => __('Employee'),
                'title' => __('Employee'),
                'content' => $this->getLayout()->createBlock(
                    'Perficient\Core\Block\Adminhtml\Employee\Edit\Tab\FormInfo'
                )->toHtml(),
                'active' => true
            ]
        );
        return parent::_beforeToHtml();
    }
}
