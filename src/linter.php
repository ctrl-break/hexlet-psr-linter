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
        printResult([['descr' => $e->getMessage()." \nLinter was stopped.",
                             'name' => '-',
                        'startLine' => '0',
                        'errorType' => 'error', ],
                       ]);
        exit(2);
    }
}

function run($fileNames)
{
    $exitCode = 0;
    foreach ($fileNames as $fileName) {
        $errors = checkFileErrors($fileName);
        if (!$errors) {
            $exitCode = printResult(linter(file_get_contents($fileName)), $fileName);
        } else {
            $exitCode = printResult([$errors], $fileName);
        }
    }

    return $exitCode;
}
