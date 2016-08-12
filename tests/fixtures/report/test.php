<?php

namespace HexletPsrLinter;

function WrongFunc()
{
    $var_name = 0;
    $varName2 = 0;
    $VarName3 = 0;
    $varname4 = 0;
}

function foo()
{
    return 'bar';
}

class ClassName
{
    public function __construct()
    {
    }

    public function Wrong_Func2()
    {
    }
}

foo();
