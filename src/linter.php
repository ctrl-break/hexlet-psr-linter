<?php

namespace HexletPsrLinter;

use PhpParser\Error;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;

function linter($code)
{
    $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
    $traverser = new NodeTraverser();
    $traverser->addVisitor(new NodeVisitor());

    try {
        $stmts = $parser->parse($code);
        return $traverser->traverse($stmts);
    } catch (Error $e) {
        //eval(\Psy\sh());
            return [
                        ['descr' => $e->getMessage()." \nLinter was stopped.",
                        'funcName' => '-',
                        'startLine' => '0',
                        'errorType' => 'error', ],
                       ];
    }
}
