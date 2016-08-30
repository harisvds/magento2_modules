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

class Main extends Template
{

    protected $_blogFactory;


    public function __construct(
        Template\Context $context,
        BlogFactory $blogFactory,
        array $data = []
    )
    {
        $this->_blogFactory = $blogFactory;
        parent::__construct($context, $data);
    }

    /**
     * Set news collection
     */
    protected function _construct()
    {
        parent::_construct();
        $collection = $this->_blogFactory->create()->getCollection()
            ->setOrder('blog_id', 'DESC');
        $this->setCollection($collection);

    }

    public function getBlogs()
    {
        // Get news collection
        $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'blog.main.pager'
        );
        $pager->setLimit(3)
            ->setShowAmounts(true)
            ->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        return $this->getCollection()->load();
    }
    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

}