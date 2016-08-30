<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 3/28/2016
 * Time: 12:01 PM
 */
namespace Perficient\CronExample\Cron;

class Job {

    protected $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $loggerInterface
    ) {
        $this->logger = $loggerInterface;
    }

    public function execute() {
        mail("harishankar.malviya@perficient.com","My subject","My Message");
        $this->logger->debug('cron schedule run');
    }
}