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

    return  ['description' => 'Variable must be written in camelCase style.',
                    'name' => $var->name,
                    'line' => $startLine['startLine'],
              'error type' => 'warning',
            ];
}

function fixVarName($name)
{
    return underscoreToCamelCase($name);
}
