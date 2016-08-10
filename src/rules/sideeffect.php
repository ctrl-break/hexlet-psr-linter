<?php

namespace HexletPsrLinter;

use PhpParser\Node;

function hasSideEffectAndDeclaration(array $nodes)
{
    if ($nodes[0] instanceof Node\Stmt\Namespace_) {
        $nodes = $nodes[0]->stmts;
    }

    $sideEffect = false;
    $declaration = false;

    foreach ($nodes as $node) {
        if (($node instanceof Node\Stmt\Class_)
              || ($node instanceof Node\Stmt\Function_)
              || ($node instanceof Node\Stmt\Use_)) {
            $declaration = true;
        } else {
            $sideEffect = true;
        }
    }

    return $sideEffect && $declaration;
}

function checkSideEffect(array $nodes)
{
    if (hasSideEffectAndDeclaration($nodes)) {
        return [['descr' => 'A file SHOULD declare new symbols (classes, functions, constants, etc.)
and cause no other side effects, or it SHOULD execute logic with side effects,
but SHOULD NOT do both.',
                    'name' => '-',
                    'startLine' => '1',
                    'errorType' => 'warning',
             ]];
    };

    return false;
}
