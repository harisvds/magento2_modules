<?php
/**
 * This block renders grid columns with mass actions fields
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 4:14 PM
 */
namespace Perficient\Core\Block\Adminhtml\Employee;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;
    protected $_employeeFactory;
    protected $_status;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Perficient\Core\Model\ResourceModel\Employee\Collection $collection,
        \Perficient\Core\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    )
    {


        $this->_employeeFactory = $collection;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    public function decorateStatus($value)
    {
        $class = '';
        switch ($value) {
            case '0':
                $finalValue = "Disabled";
                $class = 'grid-severity-minor';
                break;
            case '1':
                $finalValue = "Enabled";
                $class = 'grid-severity-notice';
                break;
            case '0':
            default:
                $finalValue = "Disabled";
                $class = 'grid-severity-critical';
                break;
        }

        return '<span class="' . $class . '"><span>' . $finalValue . '</span></span>';
    }

    /**
     * @return string
     */
/*    public function getGridUrl()
    {
        return $this->getUrl('core/employee/grid', ['_current' => true]);
    }*/

    /**
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'core/employee/edit',
            ['employee_id' => $row->getId()]
        );
    }

    /**
     * @return void
     */
    protected function _construct()
    {

        parent::_construct();
        $this->setDefaultSort('employee_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        //$this->setUseAjax(true);

    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {

        $this->setCollection($this->_employeeFactory);
        parent::_prepareCollection();
        return $this;
    }

    /**
     * Prepare grid columns
     *
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'employee_id',
            [
                'header' => __('Employee ID'),
                'index' => 'employee_id',
            ]
        );
        $this->addColumn(
            'first_name',
            [
                'header' => __('First Name'),
                'index' => 'first_name',
            ]
        );
        $this->addColumn(
            'last_name',
            [
                'header' => __('Last Name'),
                'index' => 'last_name',
            ]
        );
        $this->addColumn(
            'email',
            [
                'header' => __('Email'),
                'index' => 'email',
            ]
        );


        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'frame_callback' => [$this, 'decorateStatus']
            ]
        );
        $this->addColumn(
            'edit',
            [
                'header' => __('Action'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => 'core/employee/edit'
                        ],
                        'field' => 'employee_id'
                    ],

                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );


        return $this;
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('employee_id');
        $this->getMassactionBlock()->setFormFieldName('employee_id');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('core/employee/massdelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->toOptionArray();

        array_unshift($statuses, ['label' => '', 'value' => '']);
        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('core/employee/massstatus',
                    ['_current' => false]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );
        return $this;
    }


}