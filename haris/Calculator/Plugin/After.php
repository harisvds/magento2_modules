<?php

namespace Perficient\Calculator\Plugin;

class After
{
    public function afterDivide($calculator, $result)
    {
        echo 'The result is: ' . $result;
    }
}