<?php
namespace Perficient\Feedback\Block;

class Form extends \Magento\Framework\View\Element\Template
{
    public function getAction()
    {
        return $this->getUrl('feedback/index/post');
    }
}