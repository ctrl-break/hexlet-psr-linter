<?php

namespace HexletPsrLinter;

use Lijinma\Color;

function printResult(array $errors, $filename = '')
{
    echo PHP_EOL.Color::WHITE.$filename.PHP_EOL;
    $counter = 0;
    foreach ($errors as $err) {
        echo Color::GREEN.$err['startLine']."\t".$err['name']."\t\t";
        echo Color::YELLOW.$err['errorType'].PHP_EOL;
        echo Color::LIGHT_GRAY.$err['descr'].PHP_EOL;
        ++$counter;
    }
    if ($counter) {
        echo Color::LIGHT_RED.$counter.' problems';
    }
    echo PHP_EOL.'----------------------------------------------------'.PHP_EOL;
}

function checkFileErrors($filename)
{
    $error = false;
    if (file_exists($filename)) {
        $file = new \SplFileInfo($filename);

        if ($file->getExtension() !== 'php') {
            $error = ['descr' => 'File must have php extension',
                      'startLine' => '-',
                      'name' => $filename,
                      'errorType' => 'error',
                     ];
        }
    } else {
        $error = ['descr' => "File or directory doesn't exist",
                      'startLine' => '-',
                      'name' => $filename,
                      'errorType' => 'error',
                     ];
    }

    return $error;
}

function readDir($path)
{
    $files = [];
    $scanner = new \TheSeer\DirectoryScanner\DirectoryScanner();
    $scanner->addInclude('*.php');

    if (substr($path, 0, 1) !== '/') {
        $path = './'.$path;
    }

    foreach ($scanner($path) as $file) {
        $files[] = $file->getPathname();
    }

    return $files;
}
