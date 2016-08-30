<?php
/**
 * This block renders grid columns with mass actions fields
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 5:33 PM
 */

namespace Perficient\Elogger\Block\Adminhtml\Elogger;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $_emailLoggerFactory;
    protected $_filterVisibility = false;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Perficient\Elogger\Model\ResourceModel\EmailLogger\Collection $collection,
        array $data = []
    )
    {
        $this->_emailLoggerFactory = $collection;
        parent::__construct($context, $backendHelper, $data);
    }


    /**
     * @return string
     */
    /* public function getGridUrl()
     {
         return $this->getUrl('core/department/grid', ['_current' => true]);
     }*/


    /**
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'emaillog/index/view',
            ['email_id' => $row->getId()]
        );
    }

    /**
     * @return void
     */
    protected function _construct()
    {

        parent::_construct();
        $this->setDefaultSort('email_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        //$this->setUseAjax(true);

    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {

        $this->setCollection($this->_emailLoggerFactory);
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
            'email_id',
            [
                'header' => __('Email ID'),
                'index' => 'email_id',
            ]
        );
        $this->addColumn(
            'sender',
            [
                'header' => __('Sender'),
                'index' => 'sender',
            ]
        );
        $this->addColumn(
            'receiver',
            [
                'header' => __('Receiver'),
                'index' => 'receiver',
            ]
        );
        $this->addColumn(
            'description',
            [
                'header' => __('Action'),
                'index' => 'email_id',
                'class' => 'description-ids',
                'name' => 'email_id',
                'renderer' => 'Perficient\Elogger\Block\Adminhtml\Elogger\Grid\Renderer\Description'
            ]
        );

//        $this->addColumn('action',
//            array(
//                'header' => __('Action'),
//                'width' => '100',
//                'type' => 'action',
//                'getter' => 'getId',
//                'actions' => array(
//                    array(
//                        'caption' =>__('View'),
//                        'url' => array('base'=> '*/*/view'),
//                        'field' => 'id'
//                    )),
//                'filter' => false,
//                'sortable' => false,
//                'index' => 'stores',
//                'is_system' => true,
//            ));
        return $this;
    }



}