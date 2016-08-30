<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 6/10/2016
 * Time: 6:11 PM
 */


namespace Perficient\Helloworld\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{

    public function __construct(
        \Magento\Framework\App\Action\Context $context)
    {
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return $this
     */
    public function execute()
    {
        echo "Hello"; 
    }
}
