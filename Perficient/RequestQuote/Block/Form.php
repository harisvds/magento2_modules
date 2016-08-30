<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 7/9/2016
 * Time: 11:47 AM
 */
namespace Perficient\RequestQuote\Block;
class Form extends \Magento\Framework\View\Element\Template{

    public function getAction(){

        return $this->getUrl('quote/index/post');
    }

}