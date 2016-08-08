<?php

namespace HexletPsrLinter;

use PhpParser\Node;

class ClassName
{
    public function __construct()
    {
    }

    public function func($value = '')
    {
        return true;
    }
}

function name()
{
    echo 'side effect';

    return false;
}
