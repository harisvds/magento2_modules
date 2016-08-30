<?php
/**
 * Webkul Hello CustomPrice Observer
 *
 * @category    Webkul
 * @package     Webkul_Hello
 * @author      Webkul Software Private Limited
 *
 */
namespace Perficient\Catalog\Observer;

use Magento\Framework\Event\ObserverInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class CustomPrice implements ObserverInterface
{

    protected $_request;
    protected $_logger;

    public function __construct(\Magento\Framework\App\Request\Http $request, \Psr\Log\LoggerInterface $logger)
    {
        $this->_request = $request;
        $this->_logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $items = $observer->getEvent()->getData('quote_item');
        $product = $items->getProduct();
        if (isset($_POST['is_free'])) {

            $items = ($items->getParentItem() ? $items->getParentItem() : $items);
            $price = 0.0; //set your price here
            $items->setCustomPrice($price);
            $items->setOriginalCustomPrice($price);
            $items->getProduct()->setIsSuperMode(true);
        }
        if ($product->getTypeId() == 'bundle') {
            //$post = $this->_request->getPost();


            try {
                $options = $items->getChildren();
                foreach ($options as $index => $child) {
                    //echo "\nIn side function".$child->getQuoteId();
                    //$this->_logger->info("Test Hari".$child->getData());

                    $price = 0.00;
                    $child->setCustomPrice($price);
                    $child->setOriginalCustomPrice($price);
                    $child->getProduct()->setIsSuperMode(true);
                    //exit;
                }
                //$items->save();

            } catch (Exception $e) {
                var_dump($e->getMessage());
            }


            /*$price = 0.0; //set your price here
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price);
            $item->getProduct()->setIsSuperMode(true);*/

            /* @var $resource \Magento\Bundle\Model\ResourceModel\Selection */

            /*$product=$observer->getEvent()->getProduct();
            $observer->getEvent()->getData('product');
            $item = $observer->getEvent()->getData('quote_item');
            $item = ($item->getParentItem() ? $item->getParentItem() : $item);
            $price = $product->getPrice(); //set your price here
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price);
            $item->getProduct()->setIsSuperMode(true);*/
        }
    }

}