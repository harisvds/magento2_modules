<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 2/26/2016
 * Time: 1:02 PM
 */
namespace Perficient\Blog\Model;
use Magento\Framework\Exception\LocalizedException as CoreException;
class Blog extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Perficient\Blog\Model\ResourceModel\Blog');
    }
}