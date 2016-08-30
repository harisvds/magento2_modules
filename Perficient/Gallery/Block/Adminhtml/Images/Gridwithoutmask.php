<?php

namespace Perficient\Gallery\Block\Adminhtml\Images;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

ini_set('display_errors', '1');

class Gridwithoutmask extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;
    protected $_galleryFactory;
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

        $this->_galleryFactory = $collection;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
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

        $this->setCollection($this->_galleryFactory);
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
        $this->addColumn('image_id', array(
            'header_css_class' => 'a-center',
            'header' => __('Image Id'),
            'type' => 'checkbox',
            'field_name' => 'image_id[]',
            'align' => 'center',
        ));
        $this->addColumn(
            'image_url',
            [
                'header' => __('Image'),
                'index' => 'image_url',
                'renderer'=>'Perficient\Gallery\Block\Adminhtml\Images\Grid\Renderer\Image'
            ]
        );
        $this->addColumn(
            'thombnail_url',
            [
                'header' => __('Thumbnail'),
                'index' => 'thombnail_url',

            ]
        );
        $this->addColumn(
            'thombnail_id',
            [
                'header' => __('Thumbnail ID'),
                'index' => 'thombnail_id',
                'class' => 'thombnail-id',
            ]
        );


        return $this;
    }


}