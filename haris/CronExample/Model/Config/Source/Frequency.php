<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 3/28/2016
 * Time: 5:42 PM
 */
namespace Perficient\CronExample\Model\Config\Source;
class Frequency
    implements \Magento\Framework\Option\ArrayInterface
{

    const CRON_HOURLY = 'H';
    const CRON_MINUTELY = "I";
    const CRON_DAILY = 'D';
    const CRON_WEEKLY = 'W';
    const CRON_MONTHLY = 'M';
    protected static $_options;

    public function toOptionArray()
    {
        // TODO: Implement toOptionArray() method.
        if (!self::$_options) {
            self::$_options = [
                ['label' => __('Hourly'), 'value' => self::CRON_HOURLY],
                ['label' => __('Minutely'), 'value' => self::CRON_MINUTELY],
                ['label' => __('Daily'), 'value' => self::CRON_DAILY],
                ['label' => __('Weekly'), 'value' => self::CRON_WEEKLY],
                ['label' => __('Monthly'), 'value' => self::CRON_MONTHLY]
            ];
        }
        return self::$_options;
    }

}