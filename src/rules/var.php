<?php

namespace HexletPsrLinter;

function isCorrectVarName($name)
{
    return isCamelCase($name);
}

function checkVarName($var)
{
    if (isCorrectVarName($var->name)) {
        return false;
    }

    return returnErrorsInVarName($var);
}

function returnErrorsInVarName($var)
{
    $startLine = $var->getAttributes();

    return  ['descr' => 'Variable must be written in camelCase style.',
             'name' => $var->name,
             'startLine' => $startLine['startLine'],
             'errorType' => 'warning',
            ];
}

function fixVarName($name)
{
    return underscoreToCamelCase($name);
}
