<?php

namespace HexletPsrLinter;

function validateFuncName($name)
{
    $magicMethods = [
        '__construct',
        '__destruct',
        '__call',
        '__callStatic',
        '__get',
        '__set',
        '__isset',
        '__unset',
        '__sleep',
        '__wakeup',
        '__toString',
        '__invoke',
        '__set_state',
        '__clone',
        '__debugInfo',
      ];
    if (!in_array($name, $magicMethods)) {
        return isCamelCase($name);
    };
    return true;
}

function checkFuncName($func)
{
    if (validateFuncName($func->name)) {
        return false;
    }

    $startLine = $func->getAttributes();

    return [['descr' => 'Function name should be written in camelCase style',
                          'name' => $func->name,
                          'startLine' => $startLine['startLine'],
                          'errorType' => 'warning',
           ]];
}
