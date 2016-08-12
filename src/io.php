<?php

namespace HexletPsrLinter;

use Lijinma\Color;

function printResult($result)
{
    echo $result;
}

function makeReport(array $result, $format)
{
    $report = '';
    switch ($format) {
        case 'text':
            foreach ($result as $filename => $errors) {
                $report .= $filename . PHP_EOL;
                $counter = 0;
                foreach ($errors as $err) {
                    $report .= $err['line']."\t".$err['name']."\t\t";
                    $report .= $err['error type'] . PHP_EOL;
                    $report .= $err['description'] . PHP_EOL;
                    if ($err['error type'] !== 'fixed') {
                        ++$counter;
                    }
                }
                if ($counter) {
                    $report .= $counter.' problems';
                } else {
                    $report .= "\tok";
                }
                $report .= PHP_EOL . '---------------------------------------------' . PHP_EOL;
            }
            break;

        case 'json':
            foreach ($result as $filename => $errors) {
                $report .= "{". PHP_EOL;
                $report .= "\t\"" . $filename . "\":[" . PHP_EOL;
                foreach ($errors as $err) {
                    $report .= "\t{" . PHP_EOL;
                    $report .= "\t\t\"error type\" : \"" . $err['error type'] . "\",\n";
                    $report .= "\t\t\"description\" : \"" . $err['description'] . "\",\n";
                    $report .= "\t\t\"line\" : \"" . $err['line'] . "\",\n";
                    $report .= "\t\t\"name\" : \"" . $err['name'] . "\"\n";
                    $report .= "\t}," . PHP_EOL;
                }
                $report .= "]}\n";
            }
            break;

        case 'yaml':
            foreach ($result as $filename => $errors) {
                $report .= $filename . ":" . PHP_EOL;
                foreach ($errors as $err) {
                    $report .= "  - error type: " . $err['error type'] . "\n";
                    $report .= "    description: " . $err['description']. "\n";
                    $report .= "    line: " . $err['line'] . "\n";
                    $report .= "    name: " . $err['name'] . "\n";
                }
            }
            break;

        default:  // CLI
            foreach ($result as $filename => $errors) {
                $report .= PHP_EOL.Color::WHITE.$filename.PHP_EOL;
                $counter = 0;
                foreach ($errors as $err) {
                    $report .= Color::GREEN.$err['line']."\t".$err['name']."\t\t";
                    $report .= Color::YELLOW.$err['error type'].PHP_EOL;
                    $report .= Color::LIGHT_GRAY.$err['description'].PHP_EOL;
                    if ($err['error type'] !== 'fixed') {
                        ++$counter;
                    }
                }
                if ($counter) {
                    $report .= Color::LIGHT_RED.$counter.' problems';
                } else {
                    $report .= Color::GREEN."\tok";
                }
                $report .= PHP_EOL.'----------------------------------------------------'.PHP_EOL;
            }
            break;
    }

    return $report;
}

function checkFileErrors($filename, $fix = false)
{
    $error = false;
    if (file_exists($filename)) {
        $file = new \SplFileInfo($filename);

        if ($file->getExtension() !== 'php') {
            $error = ['description' => 'File must have php extension',
                             'line' => '-',
                             'name' => $filename,
                       'error type' => 'error',
                     ];
        } else {
            if ($fix && !is_writable($filename)) {
                $error = ['description' => 'Error writing to file.',
                                 'line' => '-',
                                 'name' => $filename,
                           'error type' => 'error',
                       ];
            }
        }
    } else {
        $error = ['description' => "File or directory doesn't exist",
                         'line' => '-',
                         'name' => $filename,
                   'error type' => 'error',
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

function writeFixedCode($file, $fixedCode)
{
    return file_put_contents($file, $fixedCode."\n");
}
