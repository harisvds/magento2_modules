<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 2/29/2016
 * Time: 12:33 PM
 */
namespace Perficient\Blog\Block;

use Magento\Framework\View\Element\Template;
use Perficient\Blog\Model\BlogFactory;
use Magento\Framework\Registry;

class View extends Template
{

    protected $_coreRegistry;


    public function __construct(
        Template\Context $context,
        Registry $coreRegistry,
        array $data = []
    )
    {
//        echo "ssa".$this->getRequest()->getParam('blog_id'); exit;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    /**
     * Set news collection
     */
    protected function _construct()
    {
        parent::_construct();

    }

    public function getBlog()
    {
        return $this->_coreRegistry->registry('blogData');
    }


}