<?php
/**
 * Model for the department secton for performing database releted opereations.
 * User: Harishankar.Malviya
 * Date: 5/19/2016
 * Time: 5:34 PM
 */

namespace Perficient\Core\Model;

class Department extends \Magento\Framework\Model\AbstractModel
{
 
    public function _construct()
    {
        $this->_init('Perficient\Core\Model\ResourceModel\Department');
    }
    /**
     * return department name and designation id array in form of key and value
     * @retunrs options array
     * */
    public  function  getAllOptionArray(){
        $collection=$this->getCollection()
            ->addFieldToSelect(array('department_id','name'))
            ->addFieldToFilter('status',1)
            ->getData();

        foreach($collection as $key=>$value){
            $options[$value['department_id']]=$value['name'];
        }
        return !empty($options)?$options:'';
    }

}