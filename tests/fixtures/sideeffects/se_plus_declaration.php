<?php

namespace HexletPsrLinter;

$x = 1;

echo 'i am side effect!';

$arr = [];

foo();

// declaration
function foo()
{
    return 'bar';
}
