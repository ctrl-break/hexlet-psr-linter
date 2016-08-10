<?php

namespace HexletPsrLinter;

use PhpParser\Error;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;

function linter($code, $fix = false)
{
    $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
    $traverser = new NodeTraverser();
    $traverser->addVisitor(new NodeVisitor($fix));

    try {
        $stmts = $parser->parse($code);

        return $traverser->traverse($stmts);
    } catch (Error $e) {
        return [[['descr' => $e->getMessage()." \nLinter was stopped.",
                             'name' => '-',
                        'startLine' => '0',
                        'errorType' => 'parse error',
               ]], ''];
    }
}

function run($path, $fix = false)
{
    $result = [];
    if (is_dir($path)) {
        $files = readDir($path);
    } else {
        $files = [$path];
    }
    //eval(\Psy\sh());

    foreach ($files as $file) {
        $errors = checkFileErrors($file);
        if (!$errors) {
            list($linterErrors, $fixedCode) = linter(file_get_contents($file), $fix);

            if ($linterErrors) {
                if ($fix) {
                    writeFixedCode($file, $fixedCode);
                }
                $result[$file] = $linterErrors;
            }
        } else {
            $result[$file] = $errors;
        }
    }

    return $result;
}
