<?php
/**
 * Model for the designation secton for performing database releted opereations.
 * User: Harishankar.Malviya
 * Date: 5/26/2016
 * Time: 3:09 PM
 */
namespace Perficient\Core\Model;

class Designation extends \Magento\Framework\Model\AbstractModel
{


    public function _construct()
    {
        $this->_init('Perficient\Core\Model\ResourceModel\Designation');
    }

    /**
     * return designation name and designation id array in form of key and value
     * @retunrs options array
     * */
    public function getAllOptionArray()
    {
        $collection = $this->getCollection()
            ->addFieldToSelect(array('designation_id', 'name'))
            ->addFieldToFilter('status', 1)
            ->getData();

        foreach ($collection as $key => $value) {
            $options[$value['designation_id']] = $value['name'];
        }
        $options['other']="Other";
        return $options;
    }
}