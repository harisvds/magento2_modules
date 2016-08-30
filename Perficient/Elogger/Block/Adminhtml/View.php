<?php
/**
 * This block will displya detailed information of the selected email log
 * User: Harishankar.Malviya
 * Date: 6/8/2016
 * Time: 1:31 PM
 */
namespace Perficient\Elogger\Block\Adminhtml;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class View extends Template
{

    /**
     * @var \Magento\Framework\Registry $_coreRegistry
     */
  /*  protected $_coreRegistry;
    protected $emailLogger;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        Registry $registry,
        array $data)
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);

    }

    public function getLogDetail()
    {
        $data = $this->_coreRegistry->registry('emailLoagData');
        return $data;
    }*/


}