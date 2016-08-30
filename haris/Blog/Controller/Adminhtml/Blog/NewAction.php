<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 2/26/2016
 * Time: 3:58 PM
 */

namespace Perficient\Blog\Controller\Adminhtml\Blog;

use Perficient\Blog\Controller\Adminhtml\Blog;

class NewAction extends Blog
{
    public function execute()
    {
        $this->_forward('edit');
    }
}
