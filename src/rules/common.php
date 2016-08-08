<?php

namespace HexletPsrLinter;

function isCamelCase($name)
{
    return \PHP_CodeSniffer::isCamelCaps($name);
}

function hasUnderscore($name)
{
    return (boolean) strpos($name, '_');
}
