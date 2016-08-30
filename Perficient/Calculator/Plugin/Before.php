<?php

namespace Perficient\Calculator\Plugin;

class Before
{
    public function beforeDivide($calculator, $x, $y)
    {
        echo 'Hello from before plugin <br />';
        return [5,10];
    }
}