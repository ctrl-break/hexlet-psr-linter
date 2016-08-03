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
                $err[] = ['Function name should not include the underscore',
                          $func->name,
                          $startLine['startLine'],
                          'warning',
                         ];
            }

            if (!\PHP_CodeSniffer::isCamelCaps($func->name)) {
                $err[] = ['Function name should be written in camelCase style',
                          $func->name,
                          $startLine['startLine'],
                          'warning',
                         ];
            }
        }

        return $err;
    }
}
