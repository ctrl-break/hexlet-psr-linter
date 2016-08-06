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
        return [['descr' => $e->getMessage()." \nLinter was stopped.",
                             'name' => '-',
                        'startLine' => '0',
                        'errorType' => 'error',
                ],
               ];
    }
}

function run($path)
{
    $exitCode = 0;

    if (is_dir($path)) {
        $files = readDir($path);
    } else {
        $files = [$path];
    }
    //eval(\Psy\sh());

    foreach ($files as $file) {
        $errors = checkFileErrors($file);
        if (!$errors) {
            $exitCode = printResult(linter(file_get_contents($file)), $file);
        } else {
            $exitCode = printResult([$errors], $file);
        }
    }

    return $exitCode;
}
