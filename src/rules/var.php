<?php

namespace HexletPsrLinter;

function correctVarName($name)
{
    return isCamelCase($name);
}

function checkVarName($var)
{
    if (correctVarName($var->name)) {
        return [];
    }
    $startLine = $var->getAttributes();

    return  [['descr' => 'Variable must be written in camelCase style.',
                'name' => $var->name,
                'startLine' => $startLine['startLine'],
                'errorType' => 'warning',
               ]];
}
