<?php

namespace HexletPsrLinter;

function checkFuncName($func)
{
    $magic_methods = [
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

    $err = [];
    if (!in_array($func->name, $magic_methods)) {
        $startLine = $func->getAttributes();
        if (haveUnderscore($func->name) !== false) {
            $err[] = ['descr' => 'Function name should not include the underscore',
                          'name' => $func->name,
                          'startLine' => $startLine['startLine'],
                          'errorType' => 'warning',
                         ];
        }

        if (!isCamelCase($func->name)) {
            $err[] = ['descr' => 'Function name should be written in camelCase style',
                          'name' => $func->name,
                          'startLine' => $startLine['startLine'],
                          'errorType' => 'warning',
                         ];
        }
    }

    return $err;
}
