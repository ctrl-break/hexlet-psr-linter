<?php

namespace HexletPsrLinter;

function isCamelCase($name)
{
    return \PHP_CodeSniffer::isCamelCaps($name);
}

function haveUnderscore($name)
{
    return (boolean) strpos($name, '_');
}
