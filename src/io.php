<?php

namespace HexletPsrLinter;

use Lijinma\Color;

function printResult(array $errors, $filename = '')
{
    echo Color::YELLOW.$filename.PHP_EOL;
    $counter = 0;
    foreach ($errors as $err) {
        echo Color::LIGHT_GRAY.$err['startLine']."\t".$err['name']."\t\t";
        echo Color::YELLOW.$err['errorType'].PHP_EOL;
        echo Color::GREEN.$err['descr'].PHP_EOL;
        ++$counter;
    }
    if ($counter) {
        echo Color::RED.$counter.' problems';
    } else {
        echo 'ok';
    }
    echo PHP_EOL.'----------------------------------------------------'.PHP_EOL;
}

function checkFileErrors($fileName)
{
    $error = false;
    if (file_exists($fileName)) {
        $file = new \SplFileInfo($fileName);

        if ($file->getExtension() !== 'php') {
            $error = ['descr' => 'File must have php extension',
                      'startLine' => '-',
                      'name' => $fileName,
                      'errorType' => 'error',
                     ];
        }
    } else {
        $error = ['descr' => "File doesn't exist",
                  'startLine' => '-',
                  'name' => $fileName,
                  'errorType' => 'error',
                 ];
    }

    return $error;
}
