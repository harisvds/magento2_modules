<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 6/7/2016
 * Time: 11:43 AM
 */
namespace Perficient\Elogger\Framework\Mail;

use Magento\Framework\Mail\MessageInterface;
use Magento\Framework\Mail\Transport as CoreTransport;
use Perficient\Elogger\Model\EmailLogger;
use Psr\Log\LoggerInterface;


class Transport extends CoreTransport
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var EmailLogger
     */
    protected $emailLogger;

    /**
     * @var EmaiLoggerHelper
     */
    protected $helper;

    /**
     * @param LoggerInterface $logger
     * @param EmailLogger $emailLogger
     * @param EmaiLoggerHelper $helper
     * @param MessageInterface $message
     * @param array $parameters
     * @throws \InvalidArgumentException
     */
    public function __construct(
        LoggerInterface $logger,
        EmailLogger $emailLogger,
        MessageInterface $message,
        $parameters = null
    )
    {
        $this->logger = $logger;
        $this->emailLogger = $emailLogger;
        parent::__construct($message, $parameters);
    }


    /**
     * Send a mail using this transport
     *
     * @return void
     * @throws \Exception
     */
    public function sendMessage()
    {
        try {
            $body = $this->_message->getBody();
            $from = $this->_message->getFrom();
            $recipients = implode(',', $this->_message->getRecipients());
            $subject = $this->_message->getSubject();
            $content = $body->getRawContent();
            
            $this->emailLogger->setSender($from);
            $this->emailLogger->setReceiver($recipients);
            $this->emailLogger->setSubject($subject);
            $this->emailLogger->setDescription($content);
            $this->emailLogger->save();

        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
        parent::sendMessage();
    }
}//end class