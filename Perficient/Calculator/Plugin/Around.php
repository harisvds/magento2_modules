<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 3/8/2016
 * Time: 6:34 PM
 */
namespace Perficient\Calculator\Plugin;

class Around
{
    public function aroundDivide($calculator, $divide, $x, $y)
    {
        if($y == 0)
        {
            return 'Unable to divide by 0';
        }

        $result = $divide($x, $y);
        return 'The result is: '. $result;
    }
}