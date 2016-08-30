<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 3/8/2016
 * Time: 12:23 PM
 */
namespace Perficient\Blog\Plugin;
class Productx
{
    public function beforeSetName(\Magento\Catalog\Model\Product $subject, $name)
    {
        return ['(' . $name . ')'];
    }

    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return '|' . $result . '|';
    }
}