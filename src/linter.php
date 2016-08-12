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
        return [[['description' => $e->getMessage()." \nLinter was stopped.",
                         'name' => '-',
                         'line' => '0',
                   'error type' => 'parse error',
               ]], $code];
    }
}

function run($path, array $params)
{
    isset($params['fix']) ? $fix = $params['fix'] : $fix = false;

    if (is_dir($path)) {
        $files = readDir($path);
    } else {
        $files = [$path];
    }
    //eval(\Psy\sh());

    $result = [];
    foreach ($files as $file) {
        $errors = checkFileErrors($file, $fix);
        if (!$errors) {
            list($linterErrors, $returnedCode) = linter(file_get_contents($file), $fix);

            if ($linterErrors) {
                if ($fix) {
                    writeFixedCode($file, $returnedCode);
                }
                $result[$file] = $linterErrors;
            }
        } else {
            $result[$file] = [$errors];
        }
    }

    $result = makeReport($result, $params['format']);

    return $result;
}
