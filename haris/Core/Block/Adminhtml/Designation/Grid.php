<?php
/**
 * This block renders grid columns with mass actions fields
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 4:14 PM
 */
namespace Perficient\Core\Block\Adminhtml\Designation;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;
    protected $_departmentFactory;
    protected $_status;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Perficient\Core\Model\ResourceModel\Designation\Collection $collection,
        \Perficient\Core\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    )
    {


        $this->_departmentFactory = $collection;
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
  /*  public function getGridUrl()
    {
        return $this->getUrl('core/designation/grid', ['_current' => true]);
    }*/

    /**
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'core/designation/edit',
            ['department_id' => $row->getId()]
        );
    }

    /**
     * @return void
     */
    protected function _construct()
    {

        parent::_construct();
        $this->setDefaultSort('designation_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        //$this->setUseAjax(true);

    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {

        $this->setCollection($this->_departmentFactory);
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
            'designation_id',
            [
                'header' => __('Designation ID'),
                'index' => 'designation_id',
            ]
        );
        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name',
            ]
        );
        $this->addColumn(
            'descrption',
            [
                'header' => __('Description'),
                'index' => 'description',
                'class' => 'description-ids',
                'name' => 'description'
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
                            'base' => 'core/designation/edit'
                        ],
                        'field' => 'designation_id'
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

        $this->setMassactionIdField('designation_id');
        $this->getMassactionBlock()->setFormFieldName('designation_id');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('core/designation/massdelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        array_unshift($statuses, ['label' => '', 'value' => '']);
        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('core/designation/massstatus',
                    ['_current' => true]),
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