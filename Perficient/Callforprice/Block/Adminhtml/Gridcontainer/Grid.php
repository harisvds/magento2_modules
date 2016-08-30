<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/1/2016
 * Time: 7:28 PM
 */
namespace Perficient\Callforprice\Block\Adminhtml\Gridcontainer;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $_callForPriceFactory;
    protected $_filterVisibility = false;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Perficient\Callforprice\Model\ResourceModel\Callforprice\Collection $collection,
        array $data = []
    )
    {
        $this->_callForPriceFactory = $collection;
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
   /* public function getRowUrl($row)
    {
        return $this->getUrl(
            'callforfree/index/view',
            ['email_id' => $row->getId()]
        );
    }*/

    /**
     * @return void
     */
    protected function _construct()
    {

        parent::_construct();
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        //$this->setUseAjax(true);

    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {

        $this->setCollection($this->_callForPriceFactory);
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
            'id',
            [
                'header' => __('ID'),
                'index' => 'id',
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
                'header' => __('Las Name'),
                'index' => 'last_name',
            ]
        );
        $this->addColumn(
            'product_name',
            [
                'header' => __('Product'),
                'index' => 'product_name',
            ]
        );
        $this->addColumn(
            'description',
            [
                'header' => __('Description'),
                'index' => 'description',
            ]
        );

        return $this;
    }



}