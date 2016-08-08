<?php

namespace HexletPsrLinter;

function validateVarName($name)
{
    return isCamelCase($name);
}

function checkVarName($var)
{
    if (validateVarName($var->name)) {
        return false;
    }
    $startLine = $var->getAttributes();

    return  [['descr' => 'Variable must be written in camelCase style.',
                'name' => $var->name,
                'startLine' => $startLine['startLine'],
                'errorType' => 'warning',
               ]];
}
