<?php

namespace HexletPsrLinter;

abstract class NodeInspector
{
    public static function checkFuncName($func)
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
            if (strpos($func->name, '_') !== false) {
                $err[] = ['descr' => 'Function name should not include the underscore',
                          'funcName' => $func->name,
                          'startLine' => $startLine['startLine'],
                          'errorType' => 'warning',
                         ];
            }

            if (!\PHP_CodeSniffer::isCamelCaps($func->name)) {
                $err[] = ['descr' => 'Function name should be written in camelCase style',
                          'funcName' => $func->name,
                          'startLine' => $startLine['startLine'],
                          'errorType' => 'warning',
                         ];
            }
        }

        return $err;
    }
}
