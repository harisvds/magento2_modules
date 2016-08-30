<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 3/4/2016
 * Time: 5:30 PM
 */
namespace Perficient\Obevent\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;


class CustomerLogin implements ObserverInterface
{

    /** @var \Magento\Framework\Logger\Monolog */


    public function __construct()
    {

    }

    /**
     * This is the method that fires when the event runs.
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
       /* echo "<pre>";
        print_r($observer->getData());
        echo "IN side login observer" . $observer->getEvent()->getName();
        echo "IN side login observer" . $observer->getData('controllerx');
        exit;*/
    }
}