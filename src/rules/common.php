<?php

namespace HexletPsrLinter;

function isCamelCase($name)
{
    return \PHP_CodeSniffer::isCamelCaps($name);
}
