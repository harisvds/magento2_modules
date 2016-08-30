<?php
/**
 * Defines the form fields
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 4:51 PM
 */
namespace Perficient\Core\Block\Adminhtml\Employee\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Perficient\Core\Model\Department;
use Perficient\Core\Model\Designation;
use Perficient\Core\Model\Status;

class FormInfo extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;


    protected $_status;
    protected $_department;
    protected $_designation;
    /**
     * Report field visibility
     *
     * @var array
     */
    protected $_fieldVisibility = [];

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param Status $employeeStatus
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Status $status,
        Department $department,
        Designation $designation,
        array $data = []
    )
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_status = $status;
        $this->_department = $department;
        $this->_designation = $designation;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Employee Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Employee Info');
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

        $model = $this->_coreRegistry->registry('employee_post');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );

        if ($model->getEmployeeId()) {
            $fieldset->addField(
                'employee_id',
                'hidden',
                ['name' => 'employee_id']
            );
        }
        $fieldset->addField(
            'first_name',
            'text',
            [
                'name' => 'first_name',
                'label' => __('First Name'),
                'required' => true
            ]
        );
        $fieldset->addField(
            'last_name',
            'text',
            [
                'name' => 'last_name',
                'label' => __('Last Name'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'required' => true
            ]
        );
        $department = $this->_department->getAllOptionArray();
        $fieldset->addField(
            'department_id',
            'select',
            [
                'name' => 'department_id',
                'label' => __('Department'),
                'options' => $department,
                'required' => true
            ]
        );
        $designation = $this->_designation->getAllOptionArray();
        $fieldset->addField(
            'designation_id',
            'select',
            [
                'name' => 'designation_id',
                'label' => __('Designation'),
                'options' => $designation,
                'required' => true
            ]
        );
        $fieldset->addField(
            'other_department',
            'text',
            ['name' => 'order_statuses', 'display' => 'none'],
            'designation_id'
        );
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
        // define field dependencies
        if ($this->getFieldVisibility('designation_id') && $this->getFieldVisibility('other_department')) {
            $this->setChild(
                'form_after',
                $this->getLayout()->createBlock(
                    'Magento\Backend\Block\Widget\Form\Element\Dependence'
                )->addFieldMap(
                    "designation_id",
                    'designation_id'
                )->addFieldMap(
                    "other_department",
                    'other_department'
                )->addFieldDependence(
                    'other_department',
                    'designation_id',
                    'other'
                )
            );
        }

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Get field visibility
     *
     * @param string $fieldId
     * @param bool $defaultVisibility
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    public function getFieldVisibility($fieldId, $defaultVisibility = true)
    {
        if (!array_key_exists($fieldId, $this->_fieldVisibility)) {
            return $defaultVisibility;
        }
        return $this->_fieldVisibility[$fieldId];
    }

    /**
     * Set field visibility
     *
     * @param string $fieldId
     * @param bool $visibility
     *
     * @codeCoverageIgnore
     * @return void
     */
    public function setFieldVisibility($fieldId, $visibility)
    {
        $this->_fieldVisibility[$fieldId] = (bool)$visibility;
    }


}