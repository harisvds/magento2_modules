<?php
/**
 * This block renders grid columns with mass actions fields
 * User: Harishankar.Malviya
 * Date: 5/25/2016
 * Time: 4:14 PM
 */
namespace Perficient\Core\Block\Adminhtml\Reports;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;
    protected $_employeeFactory;
    protected $_status;

    /**
     * Should Store Switcher block be visible
     *
     * @var bool
     */
    protected $_storeSwitcherVisibility = true;


    /**
     * Should Date Filter block be visible
     *
     * @var bool
     */
    protected $_dateFilterVisibility = true;


   // protected $_template = 'Perficient_Core::grid.phtml';

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

    /**
     * Return visibility of store switcher
     * @codeCoverageIgnore
     *
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    public function getStoreSwitcherVisibility()
    {
        return $this->_storeSwitcherVisibility;
    }

    /**
     * Set visibility of store switcher
     *
     * @param bool $visible
     * @codeCoverageIgnore
     * @return void
     */
    public function setStoreSwitcherVisibility($visible = true)
    {
        $this->_storeSwitcherVisibility = $visible;
    }

    /**
     * Return store switcher html
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getStoreSwitcherHtml()
    {
        return $this->getChildHtml('store_switcher');
    }

    /**
     * Return visibility of date filter
     * @codeCoverageIgnore
     *
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    public function getDateFilterVisibility()
    {
        return $this->_dateFilterVisibility;
    }

    /**
     * Set visibility of date filter
     *
     * @param bool $visible
     * @return void
     * @codeCoverageIgnore
     */
    public function setDateFilterVisibility($visible = true)
    {
        $this->_dateFilterVisibility = $visible;
    }

    /**
     * Return date filter html
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getDateFilterHtml()
    {
        return $this->getChildHtml('date_filter');
    }

    /**
     * Get periods
     *
     * @return mixed
     */
    public function getPeriods()
    {
        return $this->getCollection()->getPeriods();
    }

    /**
     * Get date format according the locale
     *
     * @return string
     */
    public function getDateFormat()
    {
        return $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
    }

    /**
     * Return refresh button html
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getRefreshButtonHtml()
    {
        return $this->getChildHtml('refresh_button');
    }

    /**
     * Get filter by key
     *
     * @param string $name
     * @return string
     */
    public function getFilter($name)
    {
        if (isset($this->_filters[$name])) {
            return $this->_filters[$name];
        } else {
            return $this->getRequest()->getParam($name) ? htmlspecialchars($this->getRequest()->getParam($name)) : '';
        }
    }

    /**
     * Set sub-report rows count
     *
     * @param int $size
     * @return void
     * @codeCoverageIgnore
     */
    public function setSubReportSize($size)
    {
        $this->_subReportSize = $size;
    }

    /**
     * Return sub-report rows count
     * @codeCoverageIgnore
     *
     * @return int
     */
    public function getSubReportSize()
    {
        return $this->_subReportSize;
    }

    /**
     * Retrieve errors
     *
     * @return array
     * @codeCoverageIgnore
     */
    public function getErrors()
    {
        return $this->_errors;
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

        return $finalValue;
    }


    /**
     * Set filter values
     *
     * @param array $data
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    protected function _setFilterValues($data)
    {
        foreach ($data as $name => $value) {
            $this->setFilter($name, $data[$name]);
        }
        return $this;
    }

    /**
     * Set filter
     *
     * @param string $name
     * @param string $value
     * @return void
     * @codeCoverageIgnore
     */
    public function setFilter($name, $value)
    {
        if ($name) {
            $this->_filters[$name] = $value;
        }
    }

    /**
     * Prepare grid filter buttons
     *
     * @return void
     */
    protected function _prepareFilterButtons()
    {
        $this->addChild(
            'refresh_button',
            'Magento\Backend\Block\Widget\Button',
            ['label' => __('Refresh'), 'onclick' => "{$this->getJsObjectName()}.doFilter();", 'class' => 'task']
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
        $this->setUseAjax(true);
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
        $this->addExportType('*/*/exportDownloadsCsv', __('CSV'));

        $this->addExportType('*/*/exportEmployeesExcel', __('Excel XML'));

        return $this;
    }


}