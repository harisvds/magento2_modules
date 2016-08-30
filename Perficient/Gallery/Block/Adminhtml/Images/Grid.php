<?php

namespace Perficient\Gallery\Block\Adminhtml\Images;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;
    protected $_imageFactory;
    protected $_status;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Perficient\Gallery\Model\ResourceModel\Images\Collection $collection,
        \Perficient\Gallery\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    )
    {

        $this->_imageFactory = $collection;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    public function decorateStatus($value)
    {
        $class = '';

        switch ($value) {
            case '0':
                $newValue = "Disabled";
                $class = 'grid-severity-minor';
                break;
            case '1':
                $newValue = "Enabled";
                $class = 'grid-severity-notice';
                break;
            case '0':
            default:
                $newValue = "Disabled";
                $class = 'grid-severity-critical';
                break;
        }

        return '<span class="' . $class . '"><span>' . $newValue . '</span></span>';
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('gallery/*/grid', ['_current' => true]);
    }

    /**
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'gallery/*/edit',
            ['image_id' => $row->getId()]
        );
    }

    /**
     * @return void
     */
    protected function _construct()
    {

        parent::_construct();
        $this->setDefaultSort('image_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        //$this->setUseAjax(true);

    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {

        $this->setCollection($this->_imageFactory);
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
            'image_id',
            [
                'header' => __('ID'),
                'index' => 'image_id'
            ]
        );
        $this->addColumn(
            'image_url',
            [
                'header' => __('Image'),
                'index' => 'image_url',
                'renderer' => 'Perficient\Gallery\Block\Adminhtml\Images\Grid\Renderer\Image'
            ]
        );
        $this->addColumn(
            'description',
            [
                'header' => __('Description'),
                'index' => 'description'
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
                            'base' => '*/*/edit'
                        ],
                        'field' => 'image_id'
                    ],
//                    [
//                        'caption' => __('Delete'),
//                        'url' => [
//                            'base' => '*/*/delete'
//                        ],
//                        'field' => 'galleryId'
//                    ],
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

        $this->setMassactionIdField('image_id');
        $this->getMassactionBlock()->setFormFieldName('image_id');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('gallery/*/MassDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        array_unshift($statuses, ['label' => '', 'value' => '']);
        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('gallery/*/massStatus',
                    ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        //'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }


}