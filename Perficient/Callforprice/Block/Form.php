<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 8/1/2016
 * Time: 6:07 PM
 */
namespace Perficient\Callforprice\Block;

class Form extends \Magento\Catalog\Block\Product\ListProduct
{
    public function getAction()
    {
        return $this->getUrl('feedback/index/post');
    }

    public function getCustomName()
    {
        return '<b><i>Custom-</i></b>';
    }
}