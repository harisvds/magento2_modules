<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/5/2016
 * Time: 1:33 PM
 */
namespace Perficient\Customshipping\Model\ResourceModel\Pfcustom;

/**
 * Shipping table rates collection
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Directory/country table name
     *
     * @var string
     */
    protected $_countryTable;

    /**
     * Directory/country_region table name
     *
     * @var string
     */
    protected $_regionTable;

    /**
     * Define resource model and item
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Perficient\Customshipping\Model\Pfcustom',
            'Perficient\Customshipping\Model\ResourceModel\Pfcustom'
        );
      /*  $this->_countryTable = $this->getTable('directory_country');
        $this->_regionTable = $this->getTable('directory_country_region');*/
    }
}

