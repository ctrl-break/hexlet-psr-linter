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
                             'name' => '-',
                        'startLine' => '0',
                        'errorType' => 'error', ],
                       ];
    }
}

function run($fileNames)
{
    foreach ($fileNames as $fileName) {
        $errors = checkFileErrors($fileName);
        if (!$errors) {
            printResult(linter(file_get_contents($fileName)), $fileName);
        } else {
            printResult([$errors], $fileName);
        }
    }
}
