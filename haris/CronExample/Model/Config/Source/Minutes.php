<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 3/28/2016
 * Time: 6:18 PM
 */
namespace Perficient\CronExample\Model\Config\Source;
class Minutes
    implements \Magento\Framework\Option\ArrayInterface
{
    protected static $_options;

    public function toOptionArray()
    {
        // TODO: Implement toOptionArray() method.
        if (!self::$_options) {
            for ($i = 5; $i <= 55; $i = $i + 5) {

                $label=(string)"$i Minute";

                self::$_options[] =
                    array('label'=>__($label),'value'=>$i);

            }
        }

        return self::$_options;
    }

}