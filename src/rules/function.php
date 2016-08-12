<?php

namespace HexletPsrLinter;

function isCorrectFuncName($name)
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
    if (isCorrectFuncName($func->name)) {
        return false;
    }

    return returnErrorsInFuncName($func);
}

function returnErrorsInFuncName($func)
{
    $startLine = $func->getAttributes();

    return ['description' => 'Function name should be written in camelCase style',
                   'name' => $func->name,
                   'line' => $startLine['startLine'],
             'error type' => 'warning',
           ];
}

function fixFuncName($func)
{
    return underscoreToCamelCase($func);
}
