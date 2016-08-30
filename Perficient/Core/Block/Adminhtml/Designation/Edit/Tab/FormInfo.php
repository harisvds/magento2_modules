<?php
/**
 * Defines the form fields
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 4:51 PM
 */
namespace Perficient\Core\Block\Adminhtml\Designation\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Perficient\Core\Model\Department;
use Perficient\Core\Model\Status;

class FormInfo extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;


    protected $_status;

    protected $_department;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param Status $designationStatus
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Status $status,
        Department $department,
        array $data = []
    )
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_status = $status;
        $this->_department = $department;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Designation Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Designation Info');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form fields
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {

        $model = $this->_coreRegistry->registry('designation_post');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );

        if ($model->getDesignationId()) {
            $fieldset->addField(
                'designation_id',
                'hidden',
                ['name' => 'designation_id']
            );
        }
        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'description',
            'textarea',
            [
                'name' => 'description',
                'label' => __('Description'),
                'required' => true,
                'style' => 'height: 15em; width: 30em;'
            ]
        );

        /* $wysiwygConfig = $this->_wysiwygConfig->getConfig();
    $fieldset->addField(
        'description',
        'editor',
        [
            'name'        => 'description',
            'label'    => __('Description'),
            'required'     => true,
            'config'    => $wysiwygConfig
        ]
    );*/
        /* $department = $this->_department->getAllOptionArray();
         $fieldset->addField(
             'department_id',
             'select',
             [
                 'name' => 'department_id',
                 'label' => __('Department'),
                 'options' => $department,
                 'required'=>true
             ]
         );*/

        $statuses = $this->_status->getOptionArray();
        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'options' => $statuses
            ]
        );


        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}