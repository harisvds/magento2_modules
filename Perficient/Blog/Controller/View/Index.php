<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 2/29/2016
 * Time: 11:38 AM
 */
namespace Perficient\Blog\Controller\View;


class Index extends \Perficient\Blog\Controller\Index\Index
{


    public function execute()
    {
        $blogId = $this->getRequest()->getParam('blog_id');
        $blog = $this->_modelBlogFactory->create()->load($blogId);
        $this->_objectManager->get('Magento\Framework\Registry')
            ->register('blogData',$blog);
        $pageFactory=$this->_pageFactory->create();
        return $pageFactory;


    }
}
