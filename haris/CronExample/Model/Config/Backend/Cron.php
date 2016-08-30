<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 3/29/2016
 * Time: 1:41 PM
 */
namespace Perficient\CronExample\Model\Config\Backend;
class Cron extends \Magento\Framework\App\Config\Value
{
    const CRON_STRING_PATH = "crontab/default/job/custom_cron/schedule/cron_expr";
    const CRON_MODEL_PATH = 'crontab/default/jobs/custom_cron/run/model';

    const XML_CRON_ENABLED = "groups/customcron/fields/enabled/value";
    const XML_CRON_TIME = "groups/customcron/fields/time/value";
    const XML_PATH_FREQUENCY = "groups/customcron/fields/frequency/value";
    const XML_CRON_MINUTE = "groups/customcron/fields/minutes/value";
    const XML_CRON_MINUTE_OF_HR = "groups/customcron/fields/minofhours/value";
    protected $_configValueFactory;
    protected $_runModelPath = '';

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Config\ValueFactory $configValueFactory,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        $runModelPath = '',
        array $data = []
    )
    {
        $this->_runModelPath = $runModelPath;
        $this->_configValueFactory = $configValueFactory;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    public function afterSave()
    {

        $enabled = $this->getData(self::XML_CRON_ENABLED);
        $time = $this->getData(self::XML_CRON_TIME);
        $frequency = $this->getData(self::XML_PATH_FREQUENCY);

        $frequencyHourly = \Perficient\CronExample\Model\Config\Source\Frequency::CRON_HOURLY;
        $frequencyMinutely = \Perficient\CronExample\Model\Config\Source\Frequency::CRON_MINUTELY;
        $frequencyWeekly = \Perficient\CronExample\Model\Config\Source\Frequency::CRON_WEEKLY;
        $frequencyMonthly = \Perficient\CronExample\Model\Config\Source\Frequency::CRON_MONTHLY;
        $frequencyDaily = \Perficient\CronExample\Model\Config\Source\Frequency::CRON_DAILY;

        if ($frequency == $frequencyMinutely) {
            $minutes = (int)$this->getData(self::XML_CRON_MINUTE);
            $cronExprString = "*/{$minutes} * * * *";
        } else if ($frequency == $frequencyHourly) {
            $minutes_of_hrs = (int)$this->getData(self::XML_CRON_MINUTE_OF_HR);
            if ($minutes_of_hrs >= 0 && $minutes_of_hrs <= 59) {
                $cronExprString = "{$minutes_of_hrs} * * * *";
            } else {

            }
        } elseif ($frequency == $frequencyDaily) {
            $timeMinutes = $time[1];
            $timeHours = $time[0];
            // Fix Midnight Issue
            if ('00' == $timeMinutes && '00' == $timeHours) {
                $timeMinutes = '59';
                $timeHours = '23';
            }
            $cronExprString = "{$timeMinutes} {$timeHours} * * *";
        } elseif ($frequency == $frequencyWeekly) {
            $timeMinutes = $time[1];
            $timeHours = $time[0];
            $cronExprString = "{$timeMinutes} {$timeHours} * * 1";
        } elseif ($frequency == $frequencyMonthly) {

            $timeMinutes = $time[1];
            $timeHours = $time[0];
            $cronExprString = "{$timeMinutes} {$timeHours} 1 * *";
        } else {
            $cronExprString = '';
        }
        try {
            $this->_configValueFactory->create()->load(
                self::CRON_STRING_PATH,
                'path'
            )->setValue(
                $cronExprString
            )->setPath(
                self::CRON_STRING_PATH
            )->save();
            $this->_configValueFactory->create()->load(
                self::CRON_MODEL_PATH,
                'path'
            )->setValue(
                $this->_runModelPath
            )->setPath(
                self::CRON_MODEL_PATH
            )->save();
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\LocalizedException(__('We can\'t save the Cron expression.'));
        }
        return parent::afterSave();
    }
}