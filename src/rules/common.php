<?php

namespace HexletPsrLinter;

function isCamelCase($name)
{
    return \PHP_CodeSniffer::isCamelCaps($name);
}

function underscoreToCamelCase($name)
{
    return lcfirst(array_reduce(explode('_', $name),
           function ($str, $item) {
               $str .= ucwords($item);

               return $str;
           }
       ));
}
