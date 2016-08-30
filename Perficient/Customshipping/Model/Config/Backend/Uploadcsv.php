<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/2/2016
 * Time: 6:24 PM
 */
namespace Perficient\Customshipping\Model\Config\Backend;

class Uploadcsv extends \Magento\Framework\App\Config\Value
{
    protected $_customShippingFactory;
    protected $_configValueFactory;
    protected $_customShipping;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Config\ValueFactory $configValueFactory,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        \Perficient\Customshipping\Model\ResourceModel\Carrier $customShippingFactory,
        $runModelPath = '',
        array $data = []
    )
    {


        $this->_customShipping = $customShippingFactory;
        $this->_configValueFactory = $configValueFactory;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    /**
     * @return $this
     */
  /*  public function afterSave()
    {

        $customShipping = $this->_customShipping->create();
        $customShipping->uploadAndImport($this);
        return parent::afterSave();
    }*/
}