<?php
/**
 * This block add tab and its contents in the admin section
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 6:55 PM
 */
namespace Perficient\Core\Block\Adminhtml\Department\Edit;

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
        $this->setId('department_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Department Information'));
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'department_info',
            [
                'label' => __('Department'),
                'title' => __('Department'),
                'content' => $this->getLayout()->createBlock(
                    'Perficient\Core\Block\Adminhtml\Department\Edit\Tab\Info'
                )->toHtml(),
                'active' => true
            ]
        );
         return parent::_beforeToHtml();
    }
}
