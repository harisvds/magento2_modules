<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 3/15/2016
 * Time: 1:18 PM
 */
namespace Perficient\Obevent\Observer;

use Magento\Checkout\Model\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Sales\Model\Order\Email\Sender\InvoiceSender;


class Custominvoice implements ObserverInterface
{
    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;
    protected $_invoicesender;
    protected $_session;
    protected $_resources;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        Session $session,
        InvoiceSender $sender)
    {
        $this->_objectManager = $objectManager;
        $this->_session = $session;
        $this->_invoiceSender = $sender;

    }

    public function execute(Observer $observer)
    {

        $order = $observer->getEvent()->getOrder();
        if ($order->canInvoice()) {
            $this->_processOrderStatus($order);
            return $this;
        }
        //echo "dfsd". $event = $observer->getEvent()->getOrder()->getId(); EXIT;
     /*   echo "dfsd". $event = $observer->getEvent()->getOrder()->getId();
        //file_put_contents('customer.txt',print_r($order->getData(),true));

        exit;
        $this->_resources = $this->_objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $this->_resources->getConnection();

        $orderTable = $this->_resources->getTableName('sales_order');
        echo $sql = "Select entity_id FROM " . $orderTable . " WHERE increment_id = " . $incrementId . ";";
        exit;
        $result = $connection->query($sql);
        var_dump($result->getData());
        exit;


        //$orderId = $this->_session->getLastRealOrder()->getId();
        //echo $orderId = $order1->getIncrementId();
        //$incrementId = $order->getIncrementId();
        $order = $this->_objectManager->create('Magento\Sales\Model\Order')->loadByIncrementId($id);

        if ($order->canInvoice()) {
            $this->_processOrderStatus($order);
            return $this;
        }*/


    }


    private function _processOrderStatus($order)
    {
        //var_dump($order->getData());
        //exit;

        $invoice = $this->_objectManager->create('Magento\Sales\Model\Service\InvoiceService')->prepareInvoice($order);
//        print_r($invoice->getData());
//        exit;
        $invoice->register();
        $invoice->save();


        $transactionSave = $this->_objectManager->create(
            'Magento\Framework\DB\Transaction'
        )->addObject(
            $invoice
        )->addObject(
            $invoice->getOrder()
        );
        $transactionSave->save();

        $this->_invoiceSender->send($invoice);

        //send notification code
        $order->addStatusHistoryComment(
            __('Notified customer about invoice #%1.', $invoice->getIncrementId())
        )
            ->setIsCustomerNotified(true)
            ->save();
        $this->_changeOrderStatus($order);
        return true;

    }

    //$this->pr($order);

    private function _changeOrderStatus($order)
    {
        $state = $order::STATE_PROCESSING;
        $order->setState($state);
        $order->setStatus($state);
        $order->save();

    }

}
